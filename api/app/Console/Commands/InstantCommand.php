<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Symfony\Component\Console\Input\InputOption;

class InstantCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'instant:app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Instant the application complete frontend and backend by tables';


    /**
     * Execute the console command.
     *
     * @return int
     *
     * @throws \Exception
     */
    public function handle()
    {
        if ($this->input->hasOption('tables')) {
            $allowTables = explode(',', $this->input->getOption('tables'));
            $db = env('DB_DATABASE');
            $tables = array_column(
                DB::select('SHOW TABLES'), 'Tables_in_'.$db
            );

            foreach ($tables as $val) {
                if (in_array($val, $allowTables)) {
                    //$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS "
                    //    . "WHERE table_name = '{$val}' AND table_schema='{$db}'";

                    //$column = array_column(DB::select($query), 'COLUMN_NAME');

                    $controller = Str::studly($val);
                    $modelClass = str_replace(' ', '',
                        ucwords(str_replace(['_', '-'], ' ', $val)));

                    $this->call('make:model', array_filter(
                        [
                            'class-name' => $modelClass,
                            '--table-name' => $val,
                        ]
                    ));

                    $this->call('make:routes', array_filter(
                        [
                            'name' => $val,
                        ]
                    ));

                    $role = strtolower(str_replace(['_'], '-', $val));
                    $this->call('make:controller', array_filter(
                        [
                            'name' => "{$controller}Controller",
                            '--resource' => true,
                            '--table' => $val,
                            '--role' => $role,
                            '--title' => ucwords(str_replace(['_', '-'], ' ', $val)),
                            '--model' => $modelClass,
                            '--force' => true,
                        ]
                    ));

                    $this->call('make:vue-api', array_filter(
                        [
                            'name' => $val,
                        ]
                    ));

                    $this->call('make:vue-menu', array_filter(
                        [
                            'name' => $val,
                        ]
                    ));

                    $this->call('make:vue-crud', array_filter(
                        [
                            'name' => $val,
                        ]
                    ));
                }
            }
        }
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['tables', null, InputOption::VALUE_REQUIRED, 'Set table name for generate controllers and models, ex: --tables=table1,table2,table3']
        ];
    }
}
