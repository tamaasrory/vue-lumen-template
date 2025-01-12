<?php
/**
 * author : tama asrory
 * email : tamaasrory@gmail.com
 */

namespace App\Console\Commands;

use App\Supports\Tools;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\InputOption;

class ExampleMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'example';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'example menu';
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Example';

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle()
    {
        $name = $this->getNameInput();
        $db = env('DB_DATABASE');
//        $tables = array_column(
//            DB::select('SHOW TABLES'), 'Tables_in_' . $db
//        );
        $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS "
            . "WHERE table_name = '{$name}' AND table_schema='{$db}' AND COLUMN_KEY='PRI'";
        $ex = DB::selectOne($query);
        var_dump($ex->COLUMN_NAME);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['name', null, InputOption::VALUE_REQUIRED, 'example a menu.']
        ];
    }

    protected function getStub()
    {
        // TODO: Implement getStub() method.
    }
}
