<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Menu;
use App\Models\Role;
use App\Models\Submenu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubmenupanelAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    private function makePanelUserWithPermission(array $actions = []): User
    {
        $role = Role::create([
            'title_fa' => 'مدیر',
            'title' => 'manager',
            'status' => 4,
        ]);

        $user = User::create([
            'name' => 'Panel User',
            'email' => 'panel-submenu-user-' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
            'level' => 'panel',
            'change_password' => 1,
        ]);

        $user->roles()->attach($role->id);

        $permission = Permission::create([
            'title' => 'submenupanel',
            'label' => 'زیرمنو پنل',
            'slug' => 'submenupanel',
            'user_id' => $user->id,
        ]);

        $role->permissions()->attach($permission->id, array_merge([
            'can_view' => false,
            'can_insert' => false,
            'can_edit' => false,
            'can_delete' => false,
        ], $actions));

        return $user;
    }

    public function test_panel_user_without_submenupanel_view_permission_gets_forbidden(): void
    {
        $role = Role::create([
            'title_fa' => 'کارشناس',
            'title' => 'expert',
            'status' => 4,
        ]);

        $user = User::create([
            'name' => 'Forbidden User',
            'email' => 'forbidden-submenupanel@example.com',
            'password' => bcrypt('password'),
            'level' => 'panel',
            'change_password' => 1,
        ]);

        $user->roles()->attach($role->id);

        $response = $this->actingAs($user, 'panel')->get('/panel/submenupanel');

        $response->assertForbidden();
    }

    public function test_panel_user_with_submenupanel_view_permission_can_access_index(): void
    {
        $user = $this->makePanelUserWithPermission(['can_view' => true]);

        $response = $this->actingAs($user, 'panel')->get('/panel/submenupanel');

        $response->assertOk();
    }

    public function test_panel_user_without_submenupanel_insert_permission_gets_forbidden(): void
    {
        $user = $this->makePanelUserWithPermission();

        $menu = Menu::create([
            'priority' => 1,
            'label' => 'Menu',
            'title' => 'menu-sub',
            'slug' => 'menu-sub',
            'submenu' => 1,
            'class' => 'index',
            'type' => 'panel',
            'controller' => 'IndexController',
            'status' => 4,
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user, 'panel')->post('/panel/submenupanel', [
            'title' => 'sub menu test',
            'label' => 'زیرمنو تست',
            'menupanel_id' => $menu->id,
            'class' => 'index',
            'controller' => 'SubmenupanelController',
            'status' => 4,
        ]);

        $response->assertForbidden();
    }

    public function test_panel_user_with_submenupanel_insert_permission_can_store(): void
    {
        $user = $this->makePanelUserWithPermission(['can_insert' => true]);

        $menu = Menu::create([
            'priority' => 1,
            'label' => 'Menu',
            'title' => 'menu-sub-ok',
            'slug' => 'menu-sub-ok',
            'submenu' => 1,
            'class' => 'index',
            'type' => 'panel',
            'controller' => 'IndexController',
            'status' => 4,
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user, 'panel')->post('/panel/submenupanel', [
            'title' => 'sub menu test ok',
            'label' => 'زیرمنو تست',
            'menupanel_id' => $menu->id,
            'class' => 'index',
            'controller' => 'SubmenupanelController',
            'status' => 4,
        ]);

        $response->assertOk();
    }

    public function test_panel_user_without_submenupanel_edit_permission_gets_forbidden_on_update(): void
    {
        $user = $this->makePanelUserWithPermission();

        $menu = Menu::create([
            'priority' => 1,
            'label' => 'Menu',
            'title' => 'menu-sub-edit',
            'slug' => 'menu-sub-edit',
            'submenu' => 1,
            'class' => 'index',
            'type' => 'panel',
            'controller' => 'IndexController',
            'status' => 4,
            'user_id' => $user->id,
        ]);

        $submenu = Submenu::create([
            'priority' => 1,
            'title' => 'submenu-edit',
            'label' => 'زیرمنو',
            'menu_id' => $menu->id,
            'slug' => 'submenu-edit',
            'type' => 'panel',
            'class' => 'index',
            'controller' => 'SubmenupanelController',
            'status' => 4,
            'user_id' => $user->id,
        ]);

        Permission::create([
            'title' => 'submenu-edit',
            'label' => 'زیرمنو',
            'slug' => $submenu->slug,
            'submenu_panel_id' => $submenu->id,
            'menu_panel_id' => $menu->id,
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user, 'panel')->put('/panel/submenupanel/' . $submenu->id, [
            'title' => 'submenu-edit-updated',
            'label' => 'زیرمنو جدید',
            'menupanel_id' => $menu->id,
            'class' => 'index',
            'controller' => 'SubmenupanelController',
            'status' => 4,
        ]);

        $response->assertForbidden();
    }

    public function test_panel_user_with_submenupanel_edit_permission_can_update(): void
    {
        $user = $this->makePanelUserWithPermission(['can_edit' => true]);

        $menu = Menu::create([
            'priority' => 1,
            'label' => 'Menu',
            'title' => 'menu-sub-edit-ok',
            'slug' => 'menu-sub-edit-ok',
            'submenu' => 1,
            'class' => 'index',
            'type' => 'panel',
            'controller' => 'IndexController',
            'status' => 4,
            'user_id' => $user->id,
        ]);

        $submenu = Submenu::create([
            'priority' => 1,
            'title' => 'submenu-edit-ok',
            'label' => 'زیرمنو',
            'menu_id' => $menu->id,
            'slug' => 'submenu-edit-ok',
            'type' => 'panel',
            'class' => 'index',
            'controller' => 'SubmenupanelController',
            'status' => 4,
            'user_id' => $user->id,
        ]);

        Permission::create([
            'title' => 'submenu-edit-ok',
            'label' => 'زیرمنو',
            'slug' => $submenu->slug,
            'submenu_panel_id' => $submenu->id,
            'menu_panel_id' => $menu->id,
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user, 'panel')->put('/panel/submenupanel/' . $submenu->id, [
            'title' => 'submenu-edit-ok-updated',
            'label' => 'زیرمنو جدید',
            'menupanel_id' => $menu->id,
            'class' => 'index',
            'controller' => 'SubmenupanelController',
            'status' => 4,
        ]);

        $response->assertOk();
    }

    public function test_panel_user_without_submenupanel_delete_permission_gets_forbidden_on_destroy(): void
    {
        $user = $this->makePanelUserWithPermission();

        $menu = Menu::create([
            'priority' => 1,
            'label' => 'Menu',
            'title' => 'menu-sub-del',
            'slug' => 'menu-sub-del',
            'submenu' => 1,
            'class' => 'index',
            'type' => 'panel',
            'controller' => 'IndexController',
            'status' => 4,
            'user_id' => $user->id,
        ]);

        $submenu = Submenu::create([
            'priority' => 1,
            'title' => 'submenu-del',
            'label' => 'زیرمنو',
            'menu_id' => $menu->id,
            'slug' => 'submenu-del',
            'type' => 'panel',
            'class' => 'index',
            'controller' => 'SubmenupanelController',
            'status' => 4,
            'user_id' => $user->id,
        ]);

        Permission::create([
            'title' => 'submenu-del',
            'label' => 'زیرمنو',
            'slug' => 'submenu-del',
            'submenu_panel_id' => $submenu->id,
            'menu_panel_id' => $menu->id,
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user, 'panel')->delete('/panel/submenupanel/' . $submenu->id);

        $response->assertForbidden();
    }

    public function test_panel_user_with_submenupanel_delete_permission_can_destroy(): void
    {
        $user = $this->makePanelUserWithPermission(['can_delete' => true]);

        $menu = Menu::create([
            'priority' => 1,
            'label' => 'Menu',
            'title' => 'menu-sub-del-ok',
            'slug' => 'menu-sub-del-ok',
            'submenu' => 1,
            'class' => 'index',
            'type' => 'panel',
            'controller' => 'IndexController',
            'status' => 4,
            'user_id' => $user->id,
        ]);

        $submenu = Submenu::create([
            'priority' => 1,
            'title' => 'submenu-del-ok',
            'label' => 'زیرمنو',
            'menu_id' => $menu->id,
            'slug' => 'submenu-del-ok',
            'type' => 'panel',
            'class' => 'index',
            'controller' => 'SubmenupanelController',
            'status' => 4,
            'user_id' => $user->id,
        ]);

        Permission::create([
            'title' => 'submenu-del-ok',
            'label' => 'زیرمنو',
            'slug' => 'submenu-del-ok',
            'submenu_panel_id' => $submenu->id,
            'menu_panel_id' => $menu->id,
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user, 'panel')->delete('/panel/submenupanel/' . $submenu->id);

        $response->assertOk();
    }
}
