<?php
/**
 * author : tama asrory
 * email : tamaasrory@gmail.com
 */

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        // $this->call('UsersTableSeeder');
        $this->call('PermissionTableSeeder');
        $this->call('CreateAdminUserSeeder');
        Model::reguard();
    }
}
