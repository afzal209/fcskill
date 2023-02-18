<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
            [
                'permission_name' => 'Gain/Profit',
            ],
            [
                'permission_name' => 'Signal',
            ],
            [
                'permission_name' => 'Prediction Ideas',
            ],
            [
                'permission_name' => 'Latest Update',
            ],
            [
                'permission_name' => 'News',
            ]
        ];
        Permission::insert($permission);
    }
}
