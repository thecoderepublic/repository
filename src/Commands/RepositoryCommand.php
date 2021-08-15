<?php

namespace TheCodeRepublic\Repository\Commands;

use Illuminate\Console\Command;

class RepositoryCommand extends Command
{

    protected $signature = 'make:repo {name : Class (User, Product)}';

    protected $description = 'Create a repository class layer over Eloquent Model';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {

        $name = $this->argument('name');

        if ( ! file_exists ( $path = base_path ( 'app/Repository' ) ) )
            mkdir($path, 0777, true);

        if ( file_exists ( base_path ( "app/Repository/{$name}Repository.php" ) ) ) {
            $this->error("Repository with that name ({$name}) already exists");
            exit(0);
        }

        self::createRepository($name);

        $this->info("Repository pattern implemented for model ". $name);

        if ($this->confirm('Would you like to star this repo?', 'yes')) {
            if(PHP_OS_FAMILY == 'Darwin') exec('open https://github.com/thecoderepublic/repository');
            if(PHP_OS_FAMILY == 'Windows') exec('start https://github.com/thecoderepublic/repository');
            if(PHP_OS_FAMILY == 'Linux') exec('xdg-open https://github.com/thecoderepublic/repository');

            $this->line("Thanks you!");
        }
    }


    protected static function getStubs($type)
    {
        return file_get_contents("vendor/thecoderepublic/repository/src/resources/$type.stub");
    }


    protected static function createRepository($name)
    {
        $template = str_replace( ['{{modelName}}'], [$name], self::GetStubs('Repository') );
        file_put_contents(base_path("app/Repository/{$name}Repository.php"), $template);
    }


}
