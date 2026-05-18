<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{

    public function run(): void
    {

        $roles = [
            [1, 'ادمین'         , 'superadmin' , 4 ],
            [2, 'مدیر'          , 'manager'    , 4 ],
            [3, 'کارشناس ارشد'  , 'senior'     , 4 ],
            [4, 'کارشناس'       , 'expert'     , 4 ],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['id' => $role[0]],
                [
                    'title_fa'   => $role[1],
                    'title'      => $role[2],
                    'status'     => $role[3],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }


    }
}
