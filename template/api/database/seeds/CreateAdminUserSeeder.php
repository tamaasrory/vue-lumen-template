<?php

use App\Models\Base\KeyGen;
use App\Models\Base\Role;
use App\Models\Base\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $domain = env('APP_DOMAIN','local.host');
        /**
         * BUAT ROLE SUPER ADMIN
         */
        $create_user = User::create([
            'id' => KeyGen::randomKey(),
            'name' => 'Super Admin',
            'email' => 'superadmin@'.$domain,
            'password' => password_hash('12345678', PASSWORD_BCRYPT)
        ]);

        /** @var User $user */
        $user = User::where('email', 'superadmin@'.$domain)->first();

        /** @var Role $role */
        $role = Role::create(['name' => 'Super Admin']);
        // atur permission yang akan diberikan
        $permissions = Permission::pluck('id', 'id')->all();
        // sinkronisasi role + permission
        $role->syncPermissions($permissions);
        // berikan akses ke user
        $user->assignRole([$role->id]);
    }
}
