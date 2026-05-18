<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ownerId = User::query()->where('email', 'hosseindbk@gmail.com')->value('id') ?? User::query()->value('id');
        $superadminRoleId = Role::query()->where('title', 'superadmin')->value('id') ?? 1;

        $submenus = [
            ['id' => 1, 'priority' => 1, 'label' => 'مدیریت منو داشبورد'    , 'title'  => 'menupanel'    , 'slug' => 'menupanel'    , 'menu_id' => 2, 'class' => 'index' , 'type'  => 'panel' , 'controller' => 'SubmenupanelController' , 'status'  => 4, 'user_id'  => $ownerId,],
            ['id' => 2, 'priority' => 2, 'label' => 'مدیریت زیرمنو داشبورد' , 'title'  => 'submenupanel' , 'slug' => 'submenupanel' , 'menu_id' => 2, 'class' => 'index' , 'type'  => 'panel' , 'controller' => 'SubmenupanelController' , 'status'  => 4, 'user_id'  => $ownerId,],
            ['id' => 3, 'priority' => 3, 'label' => 'مدیریت نقش کاربران'    , 'title'  => 'roleuser'     , 'slug' => 'roleuser'     , 'menu_id' => 3, 'class' => 'index' , 'type'  => 'panel' , 'controller' => 'RoleuserController'     , 'status'  => 4, 'user_id'  => $ownerId,],
        ];

        foreach ($submenus as $submenu) {
            DB::table('submenus')->updateOrInsert(
                ['id' => $submenu['id']],
                array_merge($submenu, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
            $submenuId = $submenu['id'];

            $permission = Permission::updateOrCreate([
                'slug' => $submenu['slug'],
            ], [
                'title'             => $submenu['title'],
                'label'             => $submenu['label'],
                'slug'              => $submenu['slug'],
                'menu_panel_id'     => $submenu['menu_id'],
                'submenu_panel_id'  => $submenuId,
                'user_id'        => $ownerId,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);

            DB::table('permission_role')->updateOrInsert(
                ['role_id' => $superadminRoleId, 'permission_id' => $permission->id],
                [
                    'can_view'      => 1,
                    'can_insert'    => 1,
                    'can_edit'      => 1,
                    'can_delete'    => 1,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]
            );
        }
    }
}
