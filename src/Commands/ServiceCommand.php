<?php

namespace TheCodeRepublic\Repository\Commands;

use Illuminate\Console\Command;

class ServiceCommand extends Command
{

    protected $signature = 'make:service {name : ServiceName (ex: ProductSearchService)}';

    protected $description = 'Create a service class to write your business logic.';

    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {

        $name = $this->argument('name');

        if ( ! file_exists ( $path = base_path ( 'app/Service' ) ) )
            mkdir($path, 0777, true);

        if ( file_exists ( base_path ( "app/Service/{$name}Service.php" ) ) ) {
            $this->error("Service with that name ({$name}) already exists");
            exit(0);
        }

        self::createService($name);

        $this->info("Service pattern implemented for model ". $name);

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


    protected static function createService($name)
    {
        $template = str_replace( ['{{serviceName}}'], [$name], self::GetStubs('Service') );
        file_put_contents(base_path("app/Service/{$name}Service.php"), $template);
    }


}
