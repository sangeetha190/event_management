<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo '---------------------------------------' . "\n";
        echo '--------Role Seeding-------' . "\n";

        $roles = [
            [
                'name' => 'Admin'
            ],
            [
                'name' => 'Developer'
            ]
        ];
        echo '--------Role Added -------' . "\n";
        foreach ($roles as $key => $value) {
            $role = new Role();
            $role->name = $value['name'];
            $role->save();
            echo "-------Roles Name=> $role->name--------------" . "\n";
        }
        $all_roles = Role::all();

        $permission = Permission::get();
        foreach ($permission as $key => $value) {
            $all_roles[0]->givePermissionTo($value->name);
            $all_roles[1]->givePermissionTo($value->name);
        }

        echo '-------Role seeding Completed...-------' . "\n";
    }
}
