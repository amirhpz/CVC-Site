<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnsureCvcPageCmsAccessSeeder extends Seeder
{
    public function run(): void
    {
        $ownerId = User::query()->where('email', 'hosseindbk@gmail.com')->value('id') ?? User::query()->value('id');
        if (!$ownerId) {
            return;
        }

        $superadminRoleId = Role::query()->where('title', 'superadmin')->value('id') ?? 1;
        $menuId = DB::table('menus')->where('type', 'panel')->where('slug', 'site-manage')->value('id')
            ?? DB::table('menus')->where('type', 'panel')->value('id');
        if (!$menuId) {
            return;
        }

        $items = [
            ['id' => 21, 'slug' => 'cvccareercontent', 'title' => 'cvccareercontent', 'label' => 'CMS صفحه همکاری', 'priority' => 21],
        ];

        foreach ($items as $item) {
            DB::table('submenus')->updateOrInsert(
                ['id' => $item['id']],
                [
                    'priority' => $item['priority'],
                    'label' => $item['label'],
                    'title' => $item['title'],
                    'slug' => $item['slug'],
                    'menu_id' => $menuId,
                    'class' => 'index',
                    'type' => 'panel',
                    'controller' => 'CvcPageContentController',
                    'status' => 4,
                    'user_id' => $ownerId,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );

            $permission = Permission::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'title' => $item['title'],
                    'label' => $item['label'],
                    'slug' => $item['slug'],
                    'menu_panel_id' => $menuId,
                    'submenu_panel_id' => $item['id'],
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
}
