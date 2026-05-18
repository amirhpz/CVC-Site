<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleuserAuthorizationTest extends TestCase
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
            'email' => 'panel-role-user-' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
            'level' => 'panel',
            'change_password' => 1,
        ]);

        $user->roles()->attach($role->id);

        $permission = Permission::create([
            'title' => 'roleuser',
            'label' => 'نقش کاربران',
            'slug' => 'roleuser',
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

    public function test_panel_user_without_roleuser_view_permission_gets_forbidden(): void
    {
        $role = Role::create([
            'title_fa' => 'کارشناس',
            'title' => 'expert',
            'status' => 4,
        ]);

        $user = User::create([
            'name' => 'Forbidden User',
            'email' => 'forbidden-roleuser@example.com',
            'password' => bcrypt('password'),
            'level' => 'panel',
            'change_password' => 1,
        ]);

        $user->roles()->attach($role->id);

        $response = $this->actingAs($user, 'panel')->get('/panel/roleuser');

        $response->assertForbidden();
    }

    public function test_panel_user_with_roleuser_view_permission_can_access_index(): void
    {
        $user = $this->makePanelUserWithPermission(['can_view' => true]);

        $response = $this->actingAs($user, 'panel')->get('/panel/roleuser');

        $response->assertOk();
    }

    public function test_panel_user_without_roleuser_insert_permission_gets_forbidden(): void
    {
        $user = $this->makePanelUserWithPermission();

        $response = $this->actingAs($user, 'panel')->post('/panel/roleuser', [
            'title_fa' => 'نقش جدید',
            'title' => 'new-role',
            'status' => 4,
        ]);

        $response->assertForbidden();
    }

    public function test_panel_user_with_roleuser_insert_permission_can_store(): void
    {
        $user = $this->makePanelUserWithPermission(['can_insert' => true]);

        $response = $this->actingAs($user, 'panel')->post('/panel/roleuser', [
            'title_fa' => 'نقش جدید',
            'title' => 'new-role-ok',
            'status' => 4,
        ]);

        $response->assertOk();
    }

    public function test_panel_user_without_roleuser_edit_permission_gets_forbidden_on_update(): void
    {
        $user = $this->makePanelUserWithPermission();

        $targetRole = Role::create([
            'title_fa' => 'کارشناس',
            'title' => 'expert-target',
            'status' => 4,
        ]);

        $response = $this->actingAs($user, 'panel')->put('/panel/roleuser/' . $targetRole->id, [
            'title_fa' => 'ویرایش نقش',
            'title' => 'expert-target-edited',
            'status' => 4,
            'permission_id' => [],
        ]);

        $response->assertForbidden();
    }

    public function test_panel_user_with_roleuser_edit_permission_can_update(): void
    {
        $user = $this->makePanelUserWithPermission(['can_edit' => true]);

        $targetRole = Role::create([
            'title_fa' => 'کارشناس',
            'title' => 'expert-target-ok',
            'status' => 4,
        ]);

        $response = $this->actingAs($user, 'panel')->put('/panel/roleuser/' . $targetRole->id, [
            'title_fa' => 'ویرایش نقش',
            'title' => 'expert-target-ok-edited',
            'status' => 4,
            'permission_id' => [],
        ]);

        $response->assertOk();
    }

    public function test_panel_user_without_roleuser_delete_permission_gets_forbidden_on_destroy(): void
    {
        $user = $this->makePanelUserWithPermission();

        $targetRole = Role::create([
            'title_fa' => 'نقش حذف',
            'title' => 'role-delete-target',
            'status' => 4,
        ]);

        $response = $this->actingAs($user, 'panel')->delete('/panel/roleuser/' . $targetRole->id);

        $response->assertForbidden();
    }

    public function test_panel_user_with_roleuser_delete_permission_can_destroy(): void
    {
        $user = $this->makePanelUserWithPermission(['can_delete' => true]);

        $targetRole = Role::create([
            'title_fa' => 'نقش حذف',
            'title' => 'role-delete-target-ok',
            'status' => 4,
        ]);

        $response = $this->actingAs($user, 'panel')->delete('/panel/roleuser/' . $targetRole->id);

        $response->assertOk();
    }
}
