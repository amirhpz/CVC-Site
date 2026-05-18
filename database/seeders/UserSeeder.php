<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure default superadmin role exists even when this seeder runs standalone.
        Role::query()->updateOrCreate(
            ['id' => 1],
            [
                'title_fa' => 'ادمین',
                'title' => 'superadmin',
                'status' => 4,
            ]
        );

        $user = User::updateOrCreate([
            'email'     => 'hosseindbk@gmail.com',
        ], [
            'name'      => 'محمد حسین دیوان بیگی',
            'username'  => 'hosseindbk',
            'level'     => 'admin',
            'role_id'   => '1',
            'password'  => Hash::make('123456789'),
        ]);

        if (!DB::table('role_user')->where('user_id', $user->id)->where('role_id', 1)->exists()) {
            DB::table('role_user')->insert([
                'user_id' => $user->id,
                'role_id' => 1,
            ]);
        }
    }
}
