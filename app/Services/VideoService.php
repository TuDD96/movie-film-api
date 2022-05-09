<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Constant;
use App\Enums\DBConstant;
use App\Enums\ErrorType;
use App\Exceptions\SystemException;
use App\Repositories\Video\VideoRepositoryInterface;
use App\Services\ImageService;
use App\Traits\CollectionPagination;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VideoService extends BaseService
{
    protected $videoRepository;
    protected $imageService;

    public function __construct(
        VideoRepositoryInterface $videoRepository,
        ImageService $imageService
    ) {
        $this->videoRepository = $videoRepository;
        $this->imageService = $imageService;
    }

    public function searchPagination($request)
    {
        $filters = [
            'title' => [
                'where' => 'like',
                'value' => null,
            ],
        ];
        $filters['title']['value'] = $request['title'] ?? '';
        $limit = $request['limit'] ?? Constant::DEFAULT_LIMIT;
        $sorts = $request['sort'] ?? '';

        $data = $this->videoRepository->search($filters);

        if (!empty($sorts)) {
            $sorts = explode(',', $sorts);
            if (is_array($sorts)) {
                foreach($sorts as $sort) {
                    if ($sort) {
                        $sort = explode('-', $sort);
                        $sortField = $sort[0];
                        $sortBy = strtolower($sort[1]);
                        if ($sortBy === Constant::ORDER_BY_ASC) {
                            $data = $data->sortBy($sortField, SORT_NATURAL|SORT_FLAG_CASE);
                        } else {
                            $data = $data->sortByDesc($sortField, SORT_NATURAL|SORT_FLAG_CASE);
                        }
                    }
                }
            }
        }
        $videos = (new CollectionPagination($data))->paginate($limit);
        foreach ($videos as $video) {
            $video->thumbnail_url = $this->getS3Url($video->video_id, true);
            $video->video_url = $this->getS3Url($video->video_id, false);
        }

        return $videos;
    }

    public function delete($request)
    {
        DB::beginTransaction();
        try {
            $videoId = $request->video_id;
            // Check if the image path entity exists
            $video = $this->videoRepository->find($videoId);
            if (!$video) {
                return [
                    'success' => false,
                    'msg' => trans('errors.MSG_5006')
                ];
            }

            // Delete the image from Amazon S3
            if (Storage::disk('s3')->exists($video->video_url)) {
                Storage::disk('s3')->delete($video->video_url);
            }
            if (Storage::disk('s3')->exists($video->thumbnail_url)) {
                Storage::disk('s3')->delete($video->thumbnail_url);
            }

            $this->videoRepository->delete($videoId);
            DB::commit();

            return [
                'success' => true,
                'msg' => trans('message.delete_success')
            ];
        } catch (Exception $exception) {
            DB::rollBack();

            return [
                'success' => false,
                'msg' => trans('errors.MSG_5006')
            ];
        }
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $data = $request->only([
                'title',
                'thumbnail_url',
                'video_url'
            ]);
            $dataUpload = [
                'thumbnail_url' => $data['thumbnail_url'],
                'video_url' => $data['video_url'],
            ];
            $data['thumbnail_url'] = '';
            $data['video_url'] = '';
            $video = $this->videoRepository->create($data);
            [$thumbnailUrl, $videoUrl] = $this->uploadImageAndVideoToS3($dataUpload, Constant::IMAGE_OBJECT_VIDEO, $video->video_id);
            $this->videoRepository->update($video->video_id, ['thumbnail_url' => $thumbnailUrl, 'video_url' => $videoUrl]);
            DB::commit();

            return [
                'success' => true,
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

    public function uploadImageAndVideoToS3($images, $object, $objectId)
    {
        DB::beginTransaction();
        try {
            $path = [];
            foreach ($images as $key => $image) {
                // Create image file name
                $imageFileName = $this->createImageFileName($objectId, $image->extension());

                // Create image directory path
                $imageDirPath = $this->createImageDirPath($object);

                // Create image file path
                $imageFilePath = config('filesystems.disks.s3.url').'/'. $imageDirPath . $imageFileName;

                // Upload to S3
                Storage::disk('s3')->putFileAs($imageDirPath, $image, $imageFileName);

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

    private function createImageFileName($objectId, $extension): string
    {
        $imageName = str_pad((string) $objectId, 11, '0', STR_PAD_LEFT) . time();
        if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg') {
            return $imageName . '_thumbnail' . '.' . $extension;
        }

        return $imageName . '_video' . '.' . $extension;
    }

    private function createImageDirPath($object): string
    {
        return config('filesystems.disks.s3.bucket_folder_main') . '/' . $object . '/';
    }

    public function getS3Url($id, $typeImage)
    {
        try {
            $disk = Storage::disk('s3');
            $video = $this->videoRepository->find($id);
            if (!$video) {
                return '';
            }
            $s3Client = $disk->getDriver()->getAdapter()->getClient();
            if ($typeImage) {
                if (config('filesystems.disks.cloudfront.url')) {
                    $path = str_replace(config('filesystems.disks.s3.url').'/','', $video->thumbnail_url);

                    return config('filesystems.disks.cloudfront.url') . '/' . $path;
                }
                $command = $s3Client->getCommand(
                    'GetObject',
                    [
                        'Bucket' => config('filesystems.disks.s3.bucket'),
//                    'Key' => $imagePathEntity->dir_path . $imagePathEntity->file_name,
                        'Key' => str_replace(config('filesystems.disks.s3.url').'/','', $video->thumbnail_url),
                        'ResponseContentDisposition' => 'attachment;',
                    ]
                );
            } else {
                if (config('filesystems.disks.cloudfront.url')) {
                    $path = str_replace(config('filesystems.disks.s3.url').'/','', $video->video_url);

                    return config('filesystems.disks.cloudfront.url') . '/' . $path;
                }
                $command = $s3Client->getCommand(
                    'GetObject',
                    [
                        'Bucket' => config('filesystems.disks.s3.bucket'),
                        'Key' => str_replace(config('filesystems.disks.s3.url').'/','', $video->video_url),
                        'ResponseContentDisposition' => 'attachment;',
                    ]
                );
            }

            $request = $s3Client->createPresignedRequest($command, '+1440 minutes');

            return (string) $request->getUri();
        } catch (\Exception $e) {
            return '';
        }
    }

    public function getListVideo($params)
    {
        $page = $params['page'] ?? Constant::DEFAULT_PAGE;
        $limit = $params['perpage'] ?? Constant::VIDEO_LIMIT;

        $videos = $this->videoRepository->getVideoList($limit, $page);

        $data = [
            'page' => $page,
            'videos' => $videos
        ];

        return $data;
    }
}
