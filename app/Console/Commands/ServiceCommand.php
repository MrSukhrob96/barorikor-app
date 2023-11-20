<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $serviceName = $this->argument('name');
        $model = ucfirst($serviceName);

        // repository interface
        $interfaceNamespace = "App\Services\Interfaces";
        $stub_i = file_get_contents(app_path('../stubs/service.interface.stub'));
        $stub_i = str_replace('{{ namespace }}', $interfaceNamespace, $stub_i);
        $stub_i = str_replace('{{ class }}', $model, $stub_i);
        $repositoryPath_i = app_path('Services/Interfaces/' . $model . 'ServiceInterface.php');

        // Make sure the directory for the interface exists
        if (!is_dir(dirname($repositoryPath_i))) {
            mkdir(dirname($repositoryPath_i), 0755, true);
        }

        file_put_contents($repositoryPath_i, $stub_i);

        // repository class
        $classNamespace = "App\Services";
        $stub = file_get_contents(app_path('../stubs/service.stub'));
        $stub = str_replace('{{ namespace }}', $classNamespace, $stub);
        $stub = str_replace('{{ class }}', $model, $stub);
        $repositoryPath = app_path('Services/' . $model . 'Service.php');

        // Make sure the directory for the class exists
        if (!is_dir(dirname($repositoryPath))) {
            mkdir(dirname($repositoryPath), 0755, true);
        }

        file_put_contents($repositoryPath, $stub);

        $this->info("Service {$serviceName} created successfully!");
    }
}
