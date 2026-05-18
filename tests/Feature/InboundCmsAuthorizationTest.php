<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InboundCmsAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    private function makePanelUserWithPermission(string $slug, array $actions = [], string $roleTitle = null): User
    {
        $role = Role::create([
            'title_fa' => 'مدیر',
            'title' => $roleTitle ?? ('manager-' . $slug),
            'status' => 4,
        ]);

        $user = User::create([
            'name' => 'Inbound CMS User',
            'email' => 'inbound-' . $slug . '-' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
            'level' => 'panel',
            'change_password' => 1,
        ]);

        $user->roles()->attach($role->id);

        $permission = Permission::create([
            'title' => $slug,
            'label' => $slug,
            'slug' => $slug,
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

    public function test_contact_message_page_requires_view_permission(): void
    {
        $userWithout = $this->makePanelUserWithPermission('contactmessage');
        $this->actingAs($userWithout, 'panel')->get('/panel/contact-message')->assertForbidden();

        $userWith = $this->makePanelUserWithPermission('contactmessage', ['can_view' => true], 'superadmin');
        $this->actingAs($userWith, 'panel')->get('/panel/contact-message')->assertOk();
    }

    public function test_career_application_page_requires_view_permission(): void
    {
        $userWithout = $this->makePanelUserWithPermission('careerapplication');
        $this->actingAs($userWithout, 'panel')->get('/panel/career-application')->assertForbidden();

        $userWith = $this->makePanelUserWithPermission('careerapplication', ['can_view' => true], 'superadmin');
        $this->actingAs($userWith, 'panel')->get('/panel/career-application')->assertOk();
    }
}
