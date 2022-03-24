<?php

namespace TheCodeRepublic\Repository;

use Illuminate\Support\ServiceProvider;
use TheCodeRepublic\Repository\Commands\BothCommand;
use TheCodeRepublic\Repository\Commands\RepositoryCommand ;
use TheCodeRepublic\Repository\Commands\ServiceCommand ;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->commands([
            RepositoryCommand::class,
            ServiceCommand::class,
            BothCommand::class,
        ]);
    }
}
