<?php

namespace App\Providers;

use App\Interfaces\Book\BookRepositoryInterface;
use App\Repositories\Book\BookRepository;
use Illuminate\Support\ServiceProvider;

class BookServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
    }
}
