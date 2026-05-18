<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CvcPageCmsTest extends TestCase
{
    use RefreshDatabase;

    private function makePanelUserWithPermission(string $slug, array $actions = [], bool $asSuperadmin = false): User
    {
        $role = Role::create([
            'title_fa' => 'مدیر',
            'title' => $asSuperadmin ? 'superadmin' : ('manager-' . $slug . '-' . uniqid()),
            'status' => 4,
        ]);

        $user = User::create([
            'name' => 'CVC Page CMS User',
            'email' => 'page-' . $slug . '-' . uniqid() . '@example.com',
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

    /** @dataProvider pageRoutes */
    public function test_page_cms_requires_view_permission(string $slug, string $url): void
    {
        $userWithout = $this->makePanelUserWithPermission($slug);
        $this->actingAs($userWithout, 'panel')->get($url)->assertForbidden();

        $userWith = $this->makePanelUserWithPermission($slug, ['can_view' => true], true);
        $this->actingAs($userWith, 'panel')->get($url)->assertOk();
    }

    public function test_page_cms_update_requires_edit_permission(): void
    {
        $user = $this->makePanelUserWithPermission('cvchomecontent', ['can_view' => true]);

        $this->actingAs($user, 'panel')
            ->put('/panel/cvc-page-content/home', [
                'page_title' => 'Home Dynamic',
            ])
            ->assertForbidden();
    }

    public static function pageRoutes(): array
    {
        return [
            ['cvchomecontent', '/panel/cvc-page-content/home'],
            ['cvchome3content', '/panel/cvc-page-content/home3'],
            ['cvcaboutcontent', '/panel/cvc-page-content/about'],
            ['cvccontactcontent', '/panel/cvc-page-content/contact'],
            ['cvccareercontent', '/panel/cvc-page-content/career'],
        ];
    }
}
