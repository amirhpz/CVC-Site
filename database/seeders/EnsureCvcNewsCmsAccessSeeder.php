<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnsureCvcNewsCmsAccessSeeder extends Seeder
{
    public function run(): void
    {
        $ownerId = User::query()->where('email', 'hosseindbk@gmail.com')->value('id') ?? User::query()->value('id');
        if (!$ownerId) {
            return;
        }
        $superadminRoleId = Role::query()->where('title', 'superadmin')->value('id') ?? 1;

        $submenuId = 10;
        $menuId = DB::table('menus')
            ->where('type', 'panel')
            ->where(function ($query) {
                $query->where('slug', 'site-manage')
                    ->orWhere('title', 'site manage');
            })
            ->value('id');

        if (!$menuId) {
            $menuId = DB::table('menus')->where('type', 'panel')->value('id');
        }

        if (!$menuId) {
            $menuId = DB::table('menus')->insertGetId([
                'priority' => 50,
                'label' => 'مدیریت سایت',
                'title' => 'site manage',
                'slug' => 'site-manage',
                'icon' => 'mdi-web',
                'submenu' => 1,
                'class' => 'index',
                'type' => 'panel',
                'controller' => 'IndexController',
                'status' => 4,
                'user_id' => $ownerId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('submenus')->updateOrInsert(
            ['id' => $submenuId],
            [
                'priority' => 10,
                'label' => 'مدیریت اخبار',
                'title' => 'post',
                'slug' => 'post',
                'menu_id' => $menuId,
                'class' => 'index',
                'type' => 'panel',
                'controller' => 'PostController',
                'status' => 4,
                'user_id' => $ownerId,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        $permission = Permission::updateOrCreate(
            ['slug' => 'post'],
            [
                'title' => 'post',
                'label' => 'مدیریت اخبار',
                'slug' => 'post',
                'menu_panel_id' => $menuId,
                'submenu_panel_id' => $submenuId,
                'user_id' => $ownerId,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        DB::table('permission_role')->updateOrInsert(
            ['role_id' => $superadminRoleId, 'permission_id' => $permission->id],
            [
                'can_view' => 1,
                'can_insert' => 1,
                'can_edit' => 1,
                'can_delete' => 1,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );
    }
}
