<?php
/**
 * Copyright (c) 2020. dibuat Oleh Tama Asrory Ridhana, S.T, MTA.
 * website : https://tamaasrory.com
 * email : tamaasrory@gmail.com
 */

namespace App\Console\Commands;

use App\Supports\Tools;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\InputOption;

class VueCrudMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:vue-crud';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a crud';
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Vue CRUD';

    /**
     * Execute the console command.
     *
     * @return bool|null
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $this->buildClass();

        $this->info($this->type . ' created successfully : ');
    }

    protected function buildClass($name = null)
    {
        $name = $this->getNameInput();
        // menu dir
        $path = Tools::feViewPath(str_replace('_', '-', strtolower($name)));

        $title = ucwords(str_replace(['-', '_'], ' ', $name));
        $exp_name = str_replace(' ', '', $title);
        $_name = str_replace(['_'], '-', $name);
        $route = str_replace(['-', ' '], '_', $name);

        $db = env('DB_DATABASE');

        // $tables = array_column(
        //     DB::select('SHOW TABLES'), 'Tables_in_pest_db'
        // );

        $show_table_cols = [];
        $data_cols = [];
        $inputs = [];
        $data_type = [];
        $data_validator = [];
        $pkey = 'not_found';
        $pkeyquery = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS "
            . "WHERE table_name = '{$name}' AND table_schema='{$db}' AND COLUMN_KEY='PRI'";
        $pkey_ex = DB::selectOne($pkeyquery);
        if (isset($pkey_ex->COLUMN_NAME)) {
            $pkey = $pkey_ex->COLUMN_NAME;
        }
        $query = "SELECT COLUMN_NAME,COLUMN_COMMENT,IS_NULLABLE FROM INFORMATION_SCHEMA.COLUMNS "
            . "WHERE table_name = '{$name}' AND table_schema='{$db}'";
        $ex = DB::select($query);
        $column = array_column($ex, 'COLUMN_NAME');
        $comment = array_column($ex, 'COLUMN_COMMENT');
        $isnullable = array_column($ex, 'IS_NULLABLE');
        $nullable = array_combine($column, $isnullable);
        $column = array_combine($column, $comment);

        foreach ($column as $key => $val) {
            $val = json_decode($val, true);
            $colName = ucwords(str_replace(['-', '_'], ' ', $key));
            if (isset($val['format'])) {
                $tmp = [];
                foreach ($val['format'] as $key2 => $val2) {
                    $colName2 = ucwords(str_replace(['-', '_'], ' ', $key2));
                    $show_table_cols[] = "{ text: '{$colName2}', value: '{$key}.{$key2}' }";
                    $tmp[] = "{$key2}: null";
                    $inputs[] = "<v-text-field v-model=\"datas.{$key}.{$key2}\" label=\"{$colName2}\" outlined "
                        . ($nullable[$key] == 'NO' ? ":rules=\"[rules.required]\"" : "") . " />";
                    if ($nullable[$key] == 'NO') {
                        $data_validator[] = "'{$key}.{$key2}': 'required'";
                    }
                }
                $data_cols[] = "{$key}: {\n          " . implode(",\n          ", $tmp) . "\n        }";
                $data_type[] = "{$key}: 'json'";
            } else {
                $show_table_cols[] = "{ text: '{$colName}', value: '{$key}' }";
                if (!in_array($key, ['created_at', 'updated_at',$pkey])) {
                    $data_cols[] = "{$key}: null";
                    $inputs[] = "<v-text-field v-model=\"datas.{$key}\" label=\"{$colName}\" outlined "
                        . ($nullable[$key] == 'NO' ? ":rules=\"[rules.required]\"" : "") . " />";
                    $data_type[] = "{$key}: 'string'";
                    if ($nullable[$key] == 'NO') {
                        $data_validator[] = "{$key}: 'required'";
                    }

                }
            }
        }

        $search = [
            '{{name}}' => $_name,
            '{{role}}' => $_name,
            '{{route}}' => $route,
            '{{title}}' => $title,
            '{{inputs}}' => implode("\n          ", $inputs),
            '// {{show_table_cols}}' => implode(",\n        ", $show_table_cols) . ',',
            '// {{data_cols}}' => implode(",\n        ", $data_cols),
            '// {{data_type}}' => implode(",\n        ", $data_type),
            '// {{data_validator}}' => implode(",\n        ", $data_validator),
            '{{export_name}}' => $exp_name,
        ];

        foreach ($this->getStub() as $key => $val) {
            $apiStub = $this->files->get($val);
            $apiStub = str_replace(array_keys($search), array_values($search), $apiStub);
            $this->makeDirectory($path . "/{$key}.vue");
            $this->files->put($path . "/{$key}.vue", $apiStub);
        }

        return true;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string[]
     */
    protected function getStub()
    {
        return [
            'Index' => __DIR__ . '/stubs/vue-crud/Index.vue.stub',
            'View' => __DIR__ . '/stubs/vue-crud/View.vue.stub',
            'Add' => __DIR__ . '/stubs/vue-crud/Add.vue.stub',
            'Edit' => __DIR__ . '/stubs/vue-crud/Edit.vue.stub',
        ];
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
