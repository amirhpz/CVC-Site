<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostAdminAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    private function makePanelUserWithPostPermission(array $actions = []): User
    {
        $role = Role::create([
            'title_fa' => 'مدیر محتوا',
            'title' => 'content-manager',
            'status' => 4,
        ]);

        $user = User::create([
            'name' => 'Post Panel User',
            'email' => 'post-panel-' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
            'level' => 'panel',
            'change_password' => 1,
        ]);

        $user->roles()->attach($role->id);

        $permission = Permission::create([
            'title' => 'post',
            'label' => 'مدیریت اخبار',
            'slug' => 'post',
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

    public function test_panel_user_without_post_view_permission_gets_forbidden(): void
    {
        $user = $this->makePanelUserWithPostPermission();

        $response = $this->actingAs($user, 'panel')->get('/panel/post');

        $response->assertForbidden();
    }

    public function test_panel_user_with_post_view_permission_can_access_index(): void
    {
        $user = $this->makePanelUserWithPostPermission(['can_view' => true]);

        $response = $this->actingAs($user, 'panel')->get('/panel/post');

        $response->assertOk();
    }
}

