<?php

namespace App\Providers;

use App\Domain\Repository\Post\IPostRepository;
use App\Domain\UseCases\Post\IPostService;
use App\Domain\UseCases\Post\PostService;
use App\Repositories\Doctrine\Post\Post;
use App\Repositories\Doctrine\Post\PostDoctrineRepository;
use App\Repositories\Eloquent\Post\PostEloquentRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            IPostService::class,
            PostService::class,
        );

//        $this->app->bind(
//            IPostRepository::class,
//            PostEloquentRepository::class,
//        );

        $this->app->bind(IPostRepository::class, function($app) {
            // This is what Doctrine's EntityRepository needs in its constructor.
            return new PostDoctrineRepository(
                $app['em'],
                $app['em']->getClassMetaData(Post::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
