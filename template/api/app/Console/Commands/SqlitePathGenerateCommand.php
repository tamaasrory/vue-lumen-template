<?php
/**
 * author : tama asrory
 * email : tamaasrory@gmail.com
 */

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class SqlitePathGenerateCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'sqlite:pointing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Get real path of SQLITE";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        sleep(3);
        $key = realpath('./database/db.sqlite');

        if ($this->option('show')) {
            return $this->line('<comment>' . $key . '</comment>');
        }

        $path = base_path('.env');

        if (file_exists($path)) {
            $_file = file_get_contents($path);
            if (strstr($_file, 'DB_DATABASE=path_of_sqlite')) {
                $_file = str_replace('DB_DATABASE=path_of_sqlite', "DB_DATABASE=" . $key, $_file);
            } else {
                $_file .= "\nDB_DATABASE=" . $key;
            }

            file_put_contents($path, $_file);
        }

        $this->info("SQLITE path [$key] set successfully.");
    }

    /**
     * Generate a random key for the application.
     *
     * @return string
     */
    protected function getRandomKey()
    {
        return Str::random(32);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('show', null, InputOption::VALUE_NONE, 'Simply display the key instead of modifying files.'),
        );
    }
}
