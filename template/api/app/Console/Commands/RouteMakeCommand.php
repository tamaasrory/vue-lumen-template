<?php
/**
 * author : tama asrory
 * email : tamaasrory@gmail.com
 */

namespace App\Console\Commands;

use App\Supports\Tools;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class RouteMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:routes';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new rotue';
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Make Route';

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
        $path = Tools::routePath('fitures.php');

        $this->files->put($path, $this->buildClass($name));

        $this->info($this->type . ' created successfully : ' . $path);
    }

    protected function buildClass($name)
    {
        $title = ucwords(str_replace(['-', '_'], ' ', $name));
        $exp_name = str_replace(' ', '', $title).'Controller';
        $_name = str_replace(['_'], '-', $name);
        $route = str_replace(['-',' '], '_', $name);

        $search = [
            '#next_use' => "use App\\Http\\Controllers\\{$exp_name};\n#next_use",
            '#next_route' => "\$router->group(['prefix' => '{$route}'], function () use (\$router) {
    \$router->get('all', [{$exp_name}::class, 'index']);
    \$router->get('detail/{id}', [{$exp_name}::class, 'show']);
    \$router->get('edit/{id}', [{$exp_name}::class, 'edit']);
    \$router->get('create', [{$exp_name}::class, 'create']);
    \$router->post('baru', [{$exp_name}::class, 'store']);
    \$router->post('update', [{$exp_name}::class, 'update']);
    \$router->delete('delete/{id}', [{$exp_name}::class, 'destroy']);
});\n#next_route",
        ];

        $stub = $this->files->get($this->getStub());
        $stub = str_replace(array_keys($search), array_values($search), $stub);

        return $stub;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return Tools::routePath('fitures.php');
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
