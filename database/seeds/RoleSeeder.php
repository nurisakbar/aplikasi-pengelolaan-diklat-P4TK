<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // memuat role dengan nama admin
        $role = Role::create(['name' => 'administrator']);

        // membuat user admin
        $user  = \App\User::create([
            'name'      =>  'Administrator',
            'email'     =>  'admin@gmail.com',
            'password'  =>  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'level'     => 'administrator'
            ]);
        

        // list permissions untuk role admin 
        $permissionModuleDiklat = ['Diklat Lihat Module Diklat','Diklat Tambah Diklat','Diklat Edit Diklat','Diklat Hapus Diklat'];
        
        foreach ($permissionModuleDiklat as $permission)
        {
            Permission::create(['name' => $permission]);
        }

        // menambahkan permission untuk admin
        $user->givePermissionTo($permissionModuleDiklat);
    }
}
