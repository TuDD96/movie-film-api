<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Constant;
use App\Enums\DBConstant;
use App\Repositories\Book\BookRepositoryInterface;
use App\Exceptions\SystemException;
use Illuminate\Support\Facades\Storage;
use Exception;
use App\Enums\ErrorType;
use App\Repositories\Video\VideoRepositoryInterface;
use App\Repositories\BookLeagueMapping\BookLeagueMappingRepositoryInterface;
use App\Repositories\League\LeagueRepositoryInterface;
use App\Repositories\UserPoint\UserPointRepositoryInterface;
use App\Repositories\Applicant\ApplicantRepositoryInterface;
use App\Repositories\Evaluation\EvaluationRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Repositories\Block\BlockRepositoryInterface;

class BookService
{
    protected $bookRepository;
    protected $bookLeagueMapping;
    protected $leagueRepository;
    protected $userPointRepository;
    protected $applicantRepository;
    protected $evaluatioRepository;
    protected $userRepository;
    protected $blockRepository;

    public function __construct(
        BookRepositoryInterface $bookRepository,
        BookLeagueMappingRepositoryInterface $bookLeagueMapping,
        LeagueRepositoryInterface $leagueRepository,
        UserPointRepositoryInterface $userPointRepository,
        ApplicantRepositoryInterface $applicantRepository,
        EvaluationRepositoryInterface $evaluatioRepository,
        UserRepositoryInterface $userRepository,
        BlockRepositoryInterface $blockRepository
    ) {
        $this->bookRepository = $bookRepository;
        $this->bookLeagueMapping = $bookLeagueMapping;
        $this->leagueRepository = $leagueRepository;
        $this->userPointRepository = $userPointRepository;
        $this->applicantRepository = $applicantRepository;
        $this->evaluatioRepository = $evaluatioRepository;
        $this->userRepository = $userRepository;
        $this->blockRepository = $blockRepository;
    }

    public function searchPagination($params)
    {
        $filters = [
            'books.user_id' => [
                'where' => '=',
                'value' => null,
            ],
            'books.title' => [
                'where' => 'like',
                'value' => null,
            ],
            'blm.league_id' => [
                'where' => '=',
                'value' => null,
            ]
        ];
        $filters['books.user_id']['value'] = $params['user_id'] ?? '';
        $filters['books.title']['value'] = $params['title'] ?? '';
        $filters['blm.league_id']['value'] = $params['league_id'] ?? '';

        $limit = $params['limit'] ?? Constant::DEFAULT_LIMIT;
        $sorts = $params['sort'] ?? '';
        $data = $this->bookRepository->getList($filters, $limit, $sorts);

        return $data;
    }

    public function updateHidden($id)
    {
        try {
            $book = $this->bookRepository->find($id);
            $hidden = ($book->is_hidden == DBConstant::BOOKS_NOT_HIDDEN) ? DBConstant::BOOKS_IS_HIDDEN : DBConstant::BOOKS_NOT_HIDDEN;
            $this->bookRepository->update($id, ['is_hidden' => $hidden]);

            return $hidden;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function getListComic($params, $userId)
    {
        $page = $params['page'] ?? Constant::DEFAULT_PAGE;
        $limit = $params['perpage'] ?? Constant::DEFAULT_LIMIT;
        $bookLeagues = $this->bookLeagueMapping->getAllBookId();
        $blockUsers = $this->blockRepository->getByUserId($userId);
        $blockBooks = $this->bookRepository->getByMultiUser($blockUsers);
        $comics = $this->bookRepository->getListComic($page, $limit, $userId, $bookLeagues, $blockBooks);
        $data = [
            'page' => $page,
            'total_page' => $comics->lastPage(),
            'comics' => $comics->shuffle()
        ];

        return $data;
    }

    public function storeBookService($request)
    {
        DB::beginTransaction();
        try {
            //verify user
            $user = $this->userRepository->verifyUser(auth('client')->user()->user_id);
            if (!$user) return ['success' => false, 'msg' => 'user doesnt exist'];
            
            $data = $request->only([
                'title',
                'thumbnail_url',
                'ebook_url',
                'league_id',
            ]);
            $dataUpload = [
                'thumbnail_url' => $data['thumbnail_url'],
                'ebook_url' => $data['ebook_url'],
            ];
            if ($data['league_id'] != 0) {
                //check league upload booked
                $lmOfUser = $this->leagueRepository->getEventActiveWithLeagueID($user->user_id, $data['league_id']);
                if (!is_null($lmOfUser->book_id)) return ['success' => false, 'msg' => '対戦ブロックごとに登録できる漫画は1つだけです。'];
                //check full league
            }
            $data['thumbnail_url'] = '';
            $data['ebook_url'] = '';
            $data['user_id'] = auth('client')->user()->user_id;
            $book = $this->bookRepository->create($data);
            [$thumbnailUrl, $ebookUrl] = $this->uploadImageAndPdfToS3($dataUpload, Constant::IMAGE_OBJECT_BOOK, $book->book_id);
            $book = $this->bookRepository->update($book->book_id, ['thumbnail_url' => $thumbnailUrl, 'ebook_url' => $ebookUrl]);
            if ($data['league_id'] != 0) {
                $this->bookLeagueMapping->create([
                    'book_id' => $book->book_id,
                    'league_id' => $data['league_id'],
                    'total_score' => 0,
                ]);
            }

            $fileName = str_replace(config('filesystems.disks.s3.url') . "/books/", "", $book->ebook_url);
            if (strpos($fileName, "fName") !== false) {
                $fN = substr(explode("__", $fileName)[0], 5) . ".pdf";
                $book->fileName = $fN;
            } else {
                $book->fileName = "Example.pdf";
            }
            DB::commit();

            return [
                'success' => true,
                'data' => $book,
                'msg' => trans('message.add_success')
            ];
        } catch (Exception $exception) {
            DB::rollBack();

            return [
                'success' => false,
                'msg' => trans('errors.MSG_5003')
            ];
        }
    }

    public function uploadImageAndPdfToS3($files, $object, $objectId)
    {
        DB::beginTransaction();
        try {
            $path = [];
            foreach ($files as $key => $file) {
                // Create image file name
                $fN = str_replace(".png", "", $file->getClientOriginalName());
                $fN = str_replace(".jpg", "", $fN);
                $fN = str_replace(".pdf", "", $fN);

                $imageFileName = $this->createImageFileName($objectId, $file->extension(), $fN);

                // Create image directory path
                $imageDirPath = $this->createImageDirPath($object);

                // Create image file path
                $imageFilePath = config('filesystems.disks.s3.url').'/'. $imageDirPath . $imageFileName;

                // Upload to S3
                Storage::disk('s3')->putFileAs($imageDirPath, $file, $imageFileName);

                if (Storage::disk('s3')->exists($imageFilePath)) {
                    throw new SystemException(ErrorType::CODE_5003, __('errors.MSG_5003'), ErrorType::STATUS_5003);
                }

                $path[] = $imageFilePath;
            }

            DB::commit();

            return $path;
        } catch (\Exception $e) {
            DB::rollBack();

            return ['', ''];
        }
    }

    private function createImageFileName($objectId, $extension, $fN): string
    {
        $fileName = "fName". $fN . "__". str_pad((string) $objectId, 8, '0', STR_PAD_LEFT) . time();

        if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg') {
            return $fileName . '_thumbnail' . '.' . $extension;
        }

        return $fileName . '_pdf' . '.' . $extension;
    }

    private function createImageDirPath($object): string
    {
        return config('filesystems.disks.s3.bucket_folder_main') . '/' . $object . '/';
    }

    public function getBookOfUser()
    {
        $data = $this->bookRepository->getBookOfUser(auth('client')->user()->user_id);
        foreach ($data as $key => $book) {
            $fileName = str_replace(config('filesystems.disks.s3.url') . "/books/", "", $book->ebook_url);
            if (strpos($fileName, "fName") !== false) {
                $fN = substr(explode("__", $fileName)[0], 5) . ".pdf";
                $book->fileName = $fN;
            } else {
                $book->fileName = "Example.pdf";
            }
        }

        return $data;
    }

    public function deleteBookService($bookId)
    {
        DB::beginTransaction();
        try {
            $book = $this->bookRepository->find($bookId);
            if ($book->user_id == auth('client')->user()->user_id) {
                $this->evaluatioRepository->deleteEvaluationOfBook($bookId);
                $this->bookLeagueMapping->deleteBookLeagueMapping($bookId);
                $this->bookRepository->delete($bookId);
                $pathImageBook = str_replace(config('filesystems.disks.s3.url'), '', $book->thumbnail_url);
                $pathBook = str_replace(config('filesystems.disks.s3.url'), '', $book->ebook_url);
                // if (Storage::disk('s3')->exists($pathImageBook)) {
                //     Storage::disk('s3')->delete($pathImageBook);
                // }
                // if (Storage::disk('s3')->exists($pathBook)) {
                //     Storage::disk('s3')->delete($pathBook);
                // }

                DB::commit();
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return false;
        }
    }

    public function block($userId, $bookId)
    {
        try {
            $book = $this->bookRepository->getUnHiddenBook($bookId);

            if (!$book) return false;
            
            $blockUser = $this->blockRepository->getFrotmAndToUserId($userId, $book->user_id);

            if ($blockUser) return false;

            $this->blockRepository->create([
                'from_user_id' => $userId,
                'to_user_id' => $book->user_id
            ]);

            return true;
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
