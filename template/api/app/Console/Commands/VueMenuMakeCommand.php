<?php
/**
 * Copyright (c) 2020. dibuat Oleh Tama Asrory Ridhana, S.T, MTA.
 * website : https://tamaasrory.com
 * email : tamaasrory@gmail.com
 */

namespace App\Console\Commands;

use App\Supports\Tools;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class VueMenuMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:vue-menu';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new menu';
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Vue Menu';

    /**
     * Execute the console command.
     *
     * @return bool|null
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $name = $this->getNameInput();
        // menu dir
        $path = Tools::feMenuPath(str_replace('_', '-', strtolower($name)) . '.js');

        $this->makeDirectory($path);

        $this->files->put($path, $this->buildClass($name));

        $this->info($this->type . ' created successfully : ' . $path);
    }

    protected function buildClass($name)
    {
        $title = ucwords(str_replace(['-', '_'], ' ', $name));
        $exp_name = str_replace(' ', '', $title);
        $_name = str_replace(['_'], '-', $name);
        $route = str_replace(['-',' '], '_', $name);

        $search = [
            '{{name}}' => $_name,
            '{{route}}' => $route,
            '{{title}}' => $title,
            '{{export_name}}' => $exp_name,
        ];

        $stub = $this->files->get($this->getStub());
        $stub = str_replace(array_keys($search), array_values($search), $stub);

        $search = [
            '// {{next_import}}' => "import {$exp_name} from './menus/{$_name}.js'\n// {{next_import}}",
            '// {{next_use}}' => ",\n  {$exp_name}// {{next_use}}",
        ];

        $getApiStub = Tools::frontendPath().'/src/router/menus.js';
        $apiStub = $this->files->get($getApiStub);
        $apiStub = str_replace(array_keys($search), array_values($search), $apiStub);
        $this->files->put($getApiStub, $apiStub);

        return $stub;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/vue-menu.stub';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['name', null, InputOption::VALUE_REQUIRED, 'Generate a menu.']
        ];
    }
}
