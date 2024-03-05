<?php

namespace Database\Seeders;

use App\Models\PermissionGroup;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'User create',
                'permission_group_id' => PermissionGroup::where('name', 'User Management')->first()->id
            ],
            [
                'name' => 'User edit',
                'permission_group_id' => PermissionGroup::where('name', 'User Management')->first()->id
            ],
            [
                'name' => 'User update',
                'permission_group_id' => PermissionGroup::where('name', 'User Management')->first()->id
            ],
            [
                'name' => 'User delete',
                'permission_group_id' => PermissionGroup::where('name', 'User Management')->first()->id
            ],
            [
                'name' => 'Customer create',
                'permission_group_id' => PermissionGroup::where('name', 'Customer Management')->first()->id
            ],
            [
                'name' => 'Customer edit',
                'permission_group_id' => PermissionGroup::where('name', 'Customer Management')->first()->id
            ],
            [
                'name' => 'Customer update',
                'permission_group_id' => PermissionGroup::where('name', 'Customer Management')->first()->id
            ],
            [
                'name' => 'Customer delete',
                'permission_group_id' => PermissionGroup::where('name', 'Customer Management')->first()->id
            ]
        ];
        echo '-----------------------------------' . "\n";
        echo '-------Permission seeding-------' . "\n";
        foreach ($permissions as $key => $value) {
            $permission = new Permission;
            $permission->name = $value['name'];
            $permission->permission_group_id = $value['permission_group_id'];
            $permission->save();
            echo "-------Permission  Name=> $permission->name-------" . "\n";
        }
        echo '-------Permission  seeding Completed...-------' . "\n";
    }
}
