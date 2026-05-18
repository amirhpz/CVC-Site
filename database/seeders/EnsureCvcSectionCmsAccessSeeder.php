<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnsureCvcSectionCmsAccessSeeder extends Seeder
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
            [
                'id' => 13,
                'slug' => 'cvcdomainscontent',
                'title' => 'cvcdomainscontent',
                'label' => 'CMS حوزه های سرمایه گذاری',
                'controller' => 'CvcSectionContentController',
                'priority' => 13,
            ],
            [
                'id' => 14,
                'slug' => 'cvcfaqcontent',
                'title' => 'cvcfaqcontent',
                'label' => 'CMS سوالات متداول',
                'controller' => 'CvcSectionContentController',
                'priority' => 14,
            ],
            [
                'id' => 15,
                'slug' => 'cvcinvestmentcontent',
                'title' => 'cvcinvestmentcontent',
                'label' => 'CMS درخواست سرمایه',
                'controller' => 'CvcSectionContentController',
                'priority' => 15,
            ],
            [
                'id' => 16,
                'slug' => 'cvcinvestmentprocesscontent',
                'title' => 'cvcinvestmentprocesscontent',
                'label' => 'CMS فرآیند سرمایه گذاری',
                'controller' => 'CvcSectionContentController',
                'priority' => 16,
            ],
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
                    'controller' => $item['controller'],
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
