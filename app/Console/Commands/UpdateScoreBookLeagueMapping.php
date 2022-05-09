<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\LeagueService;
use App\Repositories\Evaluation\EvaluationRepositoryInterface;
use App\Repositories\BookLeagueMapping\BookLeagueMappingRepositoryInterface;
use Exception;

class UpdateScoreBookLeagueMapping extends Command
{
    private $leagueService;
    private $evaluationRepo;
    private $bookLeagueMappingRepo;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:updateScoreBookLeagueMapping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update total score in book_league_mapping table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        LeagueService $leagueService,
        EvaluationRepositoryInterface $evaluationRepo,
        BookLeagueMappingRepositoryInterface $bookLeagueMappingRepo
    ) {
        parent::__construct();
        $this->leagueService = $leagueService;
        $this->evaluationRepo = $evaluationRepo;
        $this->bookLeagueMappingRepo = $bookLeagueMappingRepo;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $leagues = $this->leagueService->getLeagueEvaluationService();
            // fix
            foreach ($leagues as $league) {
                $leagueId = $league->league_id;
                $books = $this->evaluationRepo->getTopRanking($leagueId);
                foreach ($books as $book) {
                    $this->bookLeagueMappingRepo->updateScoreWithLeagueAndBook($book->book_id, $book->league_id, $book->total_score);
                }
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
}
