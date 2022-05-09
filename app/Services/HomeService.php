<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Constant;
use App\Repositories\RelatedLink\RelatedLinkRepositoryInterface;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\Video\VideoRepositoryInterface;
use App\Repositories\League\LeagueRepositoryInterface;
use App\Repositories\BookLeagueMapping\BookLeagueMappingRepositoryInterface;
use App\Repositories\Block\BlockRepositoryInterface;

class HomeService
{
    protected $relatedLinkRepository;

    protected $eventRepository;

    protected $bookRepository;

    protected $videoRepository;

    protected $leagueRepository;

    protected $bookLeagueMapping;

    protected $blockRepository;

    public function __construct(
        RelatedLinkRepositoryInterface $relatedLinkRepository,
        EventRepositoryInterface $eventRepository,
        BookRepositoryInterface $bookRepository,
        VideoRepositoryInterface $videoRepository,
        LeagueRepositoryInterface $leagueRepository,
        BookLeagueMappingRepositoryInterface $bookLeagueMapping,
        BlockRepositoryInterface $blockRepository
    ) {
        $this->relatedLinkRepository = $relatedLinkRepository;
        $this->eventRepository = $eventRepository;
        $this->bookRepository = $bookRepository;
        $this->videoRepository = $videoRepository;
        $this->leagueRepository = $leagueRepository;
        $this->bookLeagueMapping = $bookLeagueMapping;
        $this->blockRepository = $blockRepository;
    }

    public function getHomeData($userId)
    {
        $relatedLinks = $this->relatedLinkRepository->getDataForHome();
        $events = $this->eventRepository->getList(null, Constant::DEFAULT_PAGE, Constant::HOME_LIMIT_EVENTS)->items();
        $bookLeagues = $this->bookLeagueMapping->getAllBookId();
        $blockUsers = $this->blockRepository->getByUserId($userId);
        $blockBooks = $this->bookRepository->getByMultiUser($blockUsers);
        $books = $this->bookRepository->getListComic(Constant::DEFAULT_PAGE, Constant::HOME_LIMIT_BOOKS, $userId, $bookLeagues, $blockBooks)->items();
        $videos = $this->videoRepository->getDataForHome();
        $ranking = $this->leagueRepository->getLeagueRanking();

        return [
            'related_links' => $relatedLinks,
            'events' => $events,
            'books' => $books,
            'videos' => $videos,
            'ranking' => $ranking
        ];
    }

    public function search($params)
    {
        $page = $params['page'] ?? Constant::DEFAULT_PAGE;
        $limit = $params['perpage'] ?? Constant::HOME_LIMIT_SEARCH;
        $keyword = $params['keyword'] ?? '';
        $books = $this->bookRepository->getSearchData($keyword)->toArray();
        $videos = $this->videoRepository->getSearchData($keyword)->toArray();
        $dataSearch = array_merge($books, $videos);
        $result = array_slice($dataSearch, ($page - 1) * $limit, $limit);

        return $result;
    }
}
