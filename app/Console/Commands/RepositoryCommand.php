<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RepositoryCommand extends Command
{
    protected $signature = 'make:repository {name}';
    protected $description = 'Create a new repository';

    public function handle()
    {
        $repositoryName = $this->argument('name');
        $model = ucfirst($repositoryName);

        $this->createFileFromStub('model.stub', "Models/{$model}.php", [
            '{{ namespace }}' => 'App\Models',
            '{{ class }}' => $model,
        ]);

        $this->createFileFromStub('repository.core.interface.stub', 'Core/Interfaces/CoreRepositoryInterface.php', [
            '{{ namespace }}' => 'App\Core\Interfaces',
        ]);

        $this->createFileFromStub('repository.core.stub', 'Core/CoreRepository.php', [
            '{{ namespace }}' => 'App\Core',
        ]);

        $this->createFileFromStub('repository.interface.stub', "Repositories/Interfaces/{$model}RepositoryInterface.php", [
            '{{ namespace }}' => 'App\Repositories\Interfaces',
            '{{ class }}' => $model,
        ]);

        $this->createFileFromStub('repository.stub', "Repositories/{$model}Repository.php", [
            '{{ namespace }}' => 'App\Repositories',
            '{{ class }}' => $model,
        ]);

        $this->info("Repository {$repositoryName} created successfully!");
    }

    private function createFileFromStub($stubName, $destinationPath, $replacements)
    {
        $stub = file_get_contents(app_path("../stubs/{$stubName}"));

        foreach ($replacements as $search => $replace) {
            $stub = str_replace($search, $replace, $stub);
        }

        $directory = dirname(app_path($destinationPath));

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        file_put_contents(app_path($destinationPath), $stub);
    }
}
