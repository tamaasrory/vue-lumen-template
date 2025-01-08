<?php
/**
 * Copyright (c) 2020. dibuat Oleh Tama Asrory Ridhana, S.T, MTA.
 * website : https://tamaasrory.com
 * email : tamaasrory@gmail.com
 */

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\InputOption;

class ControllerMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:controller';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller class';
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Execute the console command.
     *
     * @return bool|null
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        // First we need to ensure that the given name is not a reserved word within the PHP
        // language and that the class name will actually be valid. If it is not valid we
        // can error now and prevent from polluting the filesystem using invalid files.
        if ($this->isReservedName($this->getNameInput())) {
            $this->error('The name "' . $this->getNameInput() . '" is reserved by PHP.');

            return false;
        }

        $name = $this->qualifyClass($this->getNameInput());

        $path = $this->getPath($name);

        // Next, We will check to see if the class already exists. If it does, we don't want
        // to create the class and overwrite the user's code. So, we will bail out so the
        // code is untouched. Otherwise, we will continue generating this class' files.
        if ((!$this->hasOption('force') ||
                !$this->option('force')) &&
            $this->alreadyExists($this->getNameInput())) {
            $this->error($this->type . ' already exists!');

            return false;
        }

        // Next, we will generate the path to the location where this class' file should get
        // written. Then, we will build the class and make the proper replacements on the
        // stub files so that it gets the correctly formatted namespace and class name.
        $this->makeDirectory($path);

        $this->files->put($path, $this->sortImports($this->buildClass($name)));

        $this->info($this->type . ' created successfully.');
    }

    protected function buildClass($name)
    {
        $db = env('DB_DATABASE');
        $tables = array_column(
            DB::select('SHOW TABLES'), 'Tables_in_' . $db
        );
        $table = $this->option('table');
        $table_property = [];
        $pkey = '_id';
        if (in_array($table, $tables)) {
            $pkeyquery = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS "
                . "WHERE table_name = '{$table}' AND table_schema='{$db}' AND COLUMN_KEY='PRI'";
            $ex = DB::selectOne($pkeyquery);
            if (isset($ex->COLUMN_NAME)) {
                $pkey = $ex->COLUMN_NAME;
            }
            $query = "SELECT COLUMN_NAME,COLUMN_COMMENT,IS_NULLABLE,COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS "
                . "WHERE table_name = '{$table}' AND table_schema='{$db}'";
            $ex = DB::select($query);
            $column = array_column($ex, 'COLUMN_NAME');
            $comment = array_column($ex, 'COLUMN_COMMENT');
            $isnullable = array_column($ex, 'IS_NULLABLE');
            $nullable = array_combine($column, $isnullable);
            $column = array_combine($column, $comment);

            foreach ($column as $key => $val) {
                if (!in_array($key, ['id', 'created_at', 'updated_at'])) {
                    $val = json_decode($val, true);
                    if (isset($val['format'])) {
                        if ($val['type'] == 'json') {
                            $table_property[] = '$data->' . $key . " = json_decode(\$request->file('{$key}')->get());";
                        }
                    } else {
                        $table_property[] = '$data->' . $key . " = \$request->input('{$key}');";
                    }
                }
            }
        }

        $search = [
            '{{role}}' => $this->option('role'),
            '{{title}}' => $this->option('title'),
            '{{model}}' => $this->option('model'),
            '{{pkey}}' => $pkey,
            '{{table_property}}' => implode("\n        ", $table_property),
        ];

        $stub = $this->files->get($this->getStub());
        $stub = str_replace(array_keys($search), array_values($search), $stub);
        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('resource')) {
            return __DIR__ . '/stubs/controller.stub';
        }
        return __DIR__ . '/stubs/controller.plain.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Controllers';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['resource', 'rs', InputOption::VALUE_NONE, 'Generate a resource controller class.'],
            ['role', 'r', InputOption::VALUE_REQUIRED, 'Set permission on middleware for controller class.'],
            ['table', 'table', InputOption::VALUE_REQUIRED, 'Set table for controller class.'],
            ['title', 't', InputOption::VALUE_REQUIRED, 'Set title for controller class.'],
            ['model', 'm', InputOption::VALUE_REQUIRED, 'Set model for controller class.'],
            ['force', 'f', InputOption::VALUE_NONE, 'overwrite controller class.'],
        ];
    }
}
