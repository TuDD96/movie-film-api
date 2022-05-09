<?php
declare(strict_types=1);

namespace App\Services;

use App\Enums\DBConstant;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Report\ReportRepositoryInterface;
use App\Repositories\Book\BookRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Mail\App\SendMailReport;
use Exception;
use Mail;

class ReportService extends BaseService
{
    protected $userRepository;
    protected $likeRepository;
    protected $bookRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        ReportRepositoryInterface $reportRepository,
        BookRepositoryInterface $bookRepository
    ) {
        $this->userRepository = $userRepository;
        $this->reportRepository = $reportRepository;
        $this->bookRepository = $bookRepository;
    }

    public function storeReport($comment, $bookId, $currentUser)
    {
        DB::beginTransaction();
        try {
            $currentU = $this->userRepository->getUser($currentUser);
            if (!$currentU) return ['status' => false];

            $book = $this->bookRepository->getUnHiddenBook($bookId);
            if (!$book) return ['status' => false];

            $report = $this->reportRepository->store($bookId, $currentUser, $comment);
            $emails = DB::table("mgmt_portal_users")
                ->pluck('email')
                ->toArray();

            Mail::to($emails)->queue(new SendMailReport($book, $comment));
            DB::commit();
            
            return ['status' => true, 'data' => $report];
        } catch (Exception $e) {
            DB::rollBack();

            return ['status' => false, 'message' => $e->getMessage()];
        }
    }
}
