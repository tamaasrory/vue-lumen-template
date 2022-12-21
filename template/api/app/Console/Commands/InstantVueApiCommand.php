<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\InputOption;

class InstantVueApiCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'instant:vue-api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Instant the vue apis';


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
                    $this->call('make:vue-api', array_filter(
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
            ['tables', null, InputOption::VALUE_REQUIRED, 'Set table name for generate vue menus, ex: --tables=table1,table2,table3']
        ];
    }
}
