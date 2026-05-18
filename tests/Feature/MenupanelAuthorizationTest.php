<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MenupanelAuthorizationTest extends TestCase
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
            'email' => 'panel-user-' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
            'level' => 'panel',
            'change_password' => 1,
        ]);

        $user->roles()->attach($role->id);

        $permission = Permission::create([
            'title' => 'menupanel',
            'label' => 'منو پنل',
            'slug' => 'menupanel',
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

    public function test_panel_user_without_menupanel_view_permission_gets_forbidden(): void
    {
        $role = Role::create([
            'title_fa' => 'کارشناس',
            'title' => 'expert',
            'status' => 4,
        ]);

        $user = User::create([
            'name' => 'Forbidden User',
            'email' => 'forbidden-menupanel@example.com',
            'password' => bcrypt('password'),
            'level' => 'panel',
            'change_password' => 1,
        ]);

        $user->roles()->attach($role->id);

        $response = $this->actingAs($user, 'panel')->get('/panel/menupanel');

        $response->assertForbidden();
    }

    public function test_panel_user_with_menupanel_view_permission_can_access_index(): void
    {
        $user = $this->makePanelUserWithPermission(['can_view' => true]);

        $response = $this->actingAs($user, 'panel')->get('/panel/menupanel');

        $response->assertOk();
    }

    public function test_panel_user_without_menupanel_insert_permission_gets_forbidden(): void
    {
        $user = $this->makePanelUserWithPermission();

        $response = $this->actingAs($user, 'panel')->post('/panel/menupanel', [
            'title' => 'menu test',
            'label' => 'منو تست',
            'Submenu' => 0,
            'class' => 'index',
            'controller' => 'IndexController',
            'status' => 4,
        ]);

        $response->assertForbidden();
    }

    public function test_panel_user_with_menupanel_insert_permission_can_store(): void
    {
        $user = $this->makePanelUserWithPermission(['can_insert' => true]);

        $response = $this->actingAs($user, 'panel')->post('/panel/menupanel', [
            'title' => 'menu test',
            'label' => 'منو تست',
            'Submenu' => 0,
            'class' => 'index',
            'controller' => 'IndexController',
            'status' => 4,
        ]);

        $response->assertOk();
    }

    public function test_panel_user_without_menupanel_edit_permission_gets_forbidden_on_update(): void
    {
        $user = $this->makePanelUserWithPermission();

        $menu = Menu::create([
            'priority' => 1,
            'label' => 'Label',
            'title' => 'menu-edit',
            'slug' => 'menu-edit',
            'submenu' => 0,
            'class' => 'index',
            'type' => 'panel',
            'controller' => 'IndexController',
            'status' => 4,
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user, 'panel')->put('/panel/menupanel/' . $menu->id, [
            'title' => 'menu-edit-updated',
            'label' => 'Label Updated',
            'submenu' => 0,
            'class' => 'index',
            'controller' => 'IndexController',
            'status' => 4,
        ]);

        $response->assertForbidden();
    }

    public function test_panel_user_with_menupanel_edit_permission_can_update(): void
    {
        $user = $this->makePanelUserWithPermission(['can_edit' => true]);

        $menu = Menu::create([
            'priority' => 1,
            'label' => 'Label',
            'title' => 'menu-edit-ok',
            'slug' => 'menu-edit-ok',
            'submenu' => 0,
            'class' => 'index',
            'type' => 'panel',
            'controller' => 'IndexController',
            'status' => 4,
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user, 'panel')->put('/panel/menupanel/' . $menu->id, [
            'title' => 'menu-edit-ok-updated',
            'label' => 'Label Updated',
            'submenu' => 0,
            'class' => 'index',
            'controller' => 'IndexController',
            'status' => 4,
        ]);

        $response->assertOk();
    }

    public function test_panel_user_without_menupanel_delete_permission_gets_forbidden_on_destroy(): void
    {
        $user = $this->makePanelUserWithPermission();

        $menu = Menu::create([
            'priority' => 1,
            'label' => 'Label',
            'title' => 'menu-delete',
            'slug' => 'menu-delete',
            'submenu' => 0,
            'class' => 'index',
            'type' => 'panel',
            'controller' => 'IndexController',
            'status' => 4,
            'user_id' => $user->id,
        ]);

        Permission::create([
            'title' => 'menu-delete',
            'label' => 'منو حذف',
            'slug' => 'menu-delete',
            'menu_panel_id' => $menu->id,
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user, 'panel')->delete('/panel/menupanel/' . $menu->id);

        $response->assertForbidden();
    }

    public function test_panel_user_with_menupanel_delete_permission_can_destroy(): void
    {
        $user = $this->makePanelUserWithPermission(['can_delete' => true]);

        $menu = Menu::create([
            'priority' => 1,
            'label' => 'Label',
            'title' => 'menu-delete-ok',
            'slug' => 'menu-delete-ok',
            'submenu' => 0,
            'class' => 'index',
            'type' => 'panel',
            'controller' => 'IndexController',
            'status' => 4,
            'user_id' => $user->id,
        ]);

        Permission::create([
            'title' => 'menu-delete-ok',
            'label' => 'منو حذف',
            'slug' => 'menu-delete-ok',
            'menu_panel_id' => $menu->id,
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user, 'panel')->delete('/panel/menupanel/' . $menu->id);

        $response->assertOk();
    }
}
