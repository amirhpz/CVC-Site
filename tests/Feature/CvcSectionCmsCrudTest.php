<?php

namespace Tests\Feature;

use App\Models\Content;
use App\Models\Menu;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Submenu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CvcSectionCmsCrudTest extends TestCase
{
    use RefreshDatabase;

    private function makePanelUserWithPermission(string $slug, array $actions = [], bool $asSuperadmin = false): User
    {
        $roleTitle = $asSuperadmin ? 'superadmin' : ('manager-' . $slug . '-' . uniqid());
        $role = Role::create([
            'title_fa' => 'مدیر',
            'title' => $roleTitle,
            'status' => 4,
        ]);

        $user = User::create([
            'name' => 'CVC CMS CRUD User',
            'email' => 'crud-' . $slug . '-' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
            'level' => 'panel',
            'change_password' => 1,
        ]);

        $menu = Menu::updateOrCreate(['id' => 1], [
            'priority' => 1,
            'label' => 'مدیریت سایت',
            'title' => 'site-manage',
            'slug' => 'site-manage',
            'icon' => 'mdi-web',
            'submenu' => 1,
            'class' => 'index',
            'type' => 'panel',
            'controller' => 'IndexController',
            'status' => 4,
            'user_id' => $user->id,
        ]);

        $submenu = Submenu::updateOrCreate(['id' => 1], [
            'priority' => 1,
            'title' => $slug,
            'label' => $slug,
            'menu_id' => 1,
            'slug' => 'fallback',
            'type' => 'panel',
            'class' => 'index',
            'controller' => 'CvcSectionContentController',
            'status' => 4,
            'user_id' => $user->id,
        ]);

        $submenu = Submenu::create([
            'priority' => 2,
            'title' => $slug,
            'label' => $slug,
            'menu_id' => 1,
            'slug' => $slug,
            'type' => 'panel',
            'class' => 'index',
            'controller' => 'CvcSectionContentController',
            'status' => 4,
            'user_id' => $user->id,
        ]);

        $user->roles()->attach($role->id);

        $permission = Permission::create([
            'title' => $slug,
            'label' => $slug,
            'slug' => $slug,
            'menu_panel_id' => 1,
            'submenu_panel_id' => $submenu->id,
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

    public function test_store_requires_insert_permission_and_creates_section_item(): void
    {
        $withoutPermission = $this->makePanelUserWithPermission('cvcfaqcontent', ['can_view' => true]);

        $this->actingAs($withoutPermission, 'panel')
            ->post('/panel/cvc-content/faq', [
                'item_title' => 'Question 1',
            ])
            ->assertForbidden();

        $withPermission = $this->makePanelUserWithPermission('cvcfaqcontent', [
            'can_view' => true,
            'can_insert' => true,
        ], true);

        $this->actingAs($withPermission, 'panel')
            ->post('/panel/cvc-content/faq', [
                'item_title' => 'Question 1',
                'item_description' => 'Answer short',
                'item_full_description' => 'Answer long',
                'item_status' => 4,
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('contents', [
            'title' => 'Question 1',
            'meta_title' => 'section:faq',
            'status' => 4,
        ]);
    }

    public function test_update_requires_edit_permission(): void
    {
        $user = $this->makePanelUserWithPermission('cvcdomainscontent', [
            'can_view' => true,
            'can_insert' => true,
        ]);

        $this->actingAs($user, 'panel')
            ->put('/panel/cvc-content/domains', [
                'page_title' => 'Domains Page',
            ])
            ->assertForbidden();
    }

    public function test_update_can_create_page_content_update_item_and_delete_item(): void
    {
        $user = $this->makePanelUserWithPermission('cvcdomainscontent', [
            'can_view' => true,
            'can_insert' => true,
            'can_edit' => true,
            'can_delete' => true,
        ]);

        $keepItem = Content::create([
            'title' => 'Old Keep',
            'meta_title' => 'section:domain',
            'status' => 4,
            'menu_id' => 1,
            'submenu_id' => 1,
            'user_id' => $user->id,
        ]);

        $deleteItem = Content::create([
            'title' => 'Old Delete',
            'meta_title' => 'section:domain',
            'status' => 4,
            'menu_id' => 1,
            'submenu_id' => 1,
            'user_id' => $user->id,
        ]);

        $this->actingAs($user, 'panel')
            ->put('/panel/cvc-content/domains', [
                'page_title' => 'Domains New Title',
                'page_description' => 'Domains summary',
                'page_full_description' => 'Domains full',
                'page_status' => 4,
                'item' => [
                    [
                        'id' => $keepItem->id,
                        'title' => 'Updated Keep',
                        'description' => 'Updated description',
                        'full_description' => 'Updated full',
                        'status' => 4,
                    ],
                ],
                'delete_items' => [$deleteItem->id],
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('contents', [
            'meta_title' => 'page:cvc-domains',
            'title' => 'Domains New Title',
        ]);

        $this->assertDatabaseHas('contents', [
            'id' => $keepItem->id,
            'meta_title' => 'section:domain',
            'title' => 'Updated Keep',
        ]);

        $this->assertDatabaseMissing('contents', [
            'id' => $deleteItem->id,
        ]);
    }
}
