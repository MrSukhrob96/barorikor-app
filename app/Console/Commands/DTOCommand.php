<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DTOCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:dto {name} {--option}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create DTO command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dtoName = $this->argument('name');
        $option = ucfirst($this->option('option'));

        $model = ucfirst($dtoName);
        
        $classNamespace = "App\DTO";
        $stub = file_get_contents(app_path('../stubs/dto.stub'));
        $stub = str_replace('{{ namespace }}', $classNamespace, $stub);
        $stub = str_replace('{{ class }}', $model, $stub);
        $stub = str_replace('{{ option }}', $option, $stub);
        $repositoryPath = app_path('DTO/' . $model . '/'. $option . $model. 'DTO.php');
    
        if (!is_dir(dirname($repositoryPath))) {
            mkdir(dirname($repositoryPath), 0755, true);
        }
    
        file_put_contents($repositoryPath, $stub);
    
        $this->info("DTO {$dtoName} created successfully!");
    }
}
