<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            \App\Repositories\ManagementPortalUser\ManagementPortalUserRepositoryInterface::class,
            \App\Repositories\ManagementPortalUser\ManagementPortalUserRepository::class
        );

        $this->app->bind(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class
        );

        $this->app->bind(
            \App\Repositories\EmailAuthn\EmailAuthnRepositoryInterface::class,
            \App\Repositories\EmailAuthn\EmailAuthnRepository::class
        );
        $this->app->bind(
            \App\Repositories\Prefecture\PrefectureRepositoryInterface::class,
            \App\Repositories\Prefecture\PrefectureRepository::class
        );

        $this->app->bind(
            \App\Repositories\Applicant\ApplicantRepositoryInterface::class,
            \App\Repositories\Applicant\ApplicantRepository::class
        );

        $this->app->bind(
            \App\Repositories\ImagePath\ImagePathRepositoryInterface::class,
            \App\Repositories\ImagePath\ImagePathRepository::class
        );

        $this->app->bind(
            \App\Repositories\Event\EventRepositoryInterface::class,
            \App\Repositories\Event\EventRepository::class
        );

        $this->app->bind(
            \App\Repositories\League\LeagueRepositoryInterface::class,
            \App\Repositories\League\LeagueRepository::class
        );

        $this->app->bind(
            \App\Repositories\Book\BookRepositoryInterface::class,
            \App\Repositories\Book\BookRepository::class
        );

        $this->app->bind(
            \App\Repositories\BookLeagueMapping\BookLeagueMappingRepositoryInterface::class,
            \App\Repositories\BookLeagueMapping\BookLeagueMappingRepository::class
        );

        $this->app->bind(
            \App\Repositories\Evaluation\EvaluationRepositoryInterface::class,
            \App\Repositories\Evaluation\EvaluationRepository::class
        );

        $this->app->bind(
            \App\Repositories\Video\VideoRepositoryInterface::class,
            \App\Repositories\Video\VideoRepository::class
        );

        $this->app->bind(
            \App\Repositories\PointsPackage\PointsPackageRepositoryInterface::class,
            \App\Repositories\PointsPackage\PointsPackageRepository::class
        );

        $this->app->bind(
            \App\Repositories\UserPoint\UserPointRepositoryInterface::class,
            \App\Repositories\UserPoint\UserPointRepository::class
        );

        $this->app->bind(
            \App\Repositories\PointsPackagePurchaseHistory\PointsPackagePurchaseHistoryRepositoryInterface::class,
            \App\Repositories\PointsPackagePurchaseHistory\PointsPackagePurchaseHistoryRepository::class
        );

        $this->app->bind(
            \App\Repositories\TransferHistory\TransferHistoryRepositoryInterface::class,
            \App\Repositories\TransferHistory\TransferHistoryRepository::class
        );

        $this->app->bind(
            \App\Repositories\Gift\GiftRepositoryInterface::class,
            \App\Repositories\Gift\GiftRepository::class
        );

        $this->app->bind(
            \App\Repositories\UserGift\UserGiftRepositoryInterface::class,
            \App\Repositories\UserGift\UserGiftRepository::class
        );

        $this->app->bind(
            \App\Repositories\GiftPurchaseHistory\GiftPurchaseHistoryRepositoryInterface::class,
            \App\Repositories\GiftPurchaseHistory\GiftPurchaseHistoryRepository::class
        );

        $this->app->bind(
            \App\Repositories\GiftTippingHistory\GiftTippingHistoryRepositoryInterface::class,
            \App\Repositories\GiftTippingHistory\GiftTippingHistoryRepository::class
        );

        $this->app->bind(
            \App\Repositories\PasswordReset\PasswordResetRepositoryInterface::class,
            \App\Repositories\PasswordReset\PasswordResetRepository::class
        );

        $this->app->bind(
            \App\Repositories\RefreshToken\RefreshTokenRepositoryInterface::class,
            \App\Repositories\RefreshToken\RefreshTokenRepository::class
        );

        $this->app->bind(
            \App\Repositories\DeviceToken\DeviceTokenRepositoryInterface::class,
            \App\Repositories\DeviceToken\DeviceTokenRepository::class
        );

        $this->app->bind(
            \App\Repositories\Prefecture\PrefectureRepositoryInterface::class,
            \App\Repositories\Prefecture\PrefectureRepository::class
        );

        $this->app->bind(
            \App\Repositories\RelatedLink\RelatedLinkRepositoryInterface::class,
            \App\Repositories\RelatedLink\RelatedLinkRepository::class
        );

        $this->app->bind(
            \App\Repositories\Report\ReportRepositoryInterface::class,
            \App\Repositories\Report\ReportRepository::class
        );

        $this->app->bind(
            \App\Repositories\Block\BlockRepositoryInterface::class,
            \App\Repositories\Block\BlockRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
