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

class ContentAdminAuthorizationAndValidationTest extends TestCase
{
    use RefreshDatabase;

    private function makePanelUserWithContentPermission(array $actions = []): User
    {
        $role = Role::create([
            'title_fa' => 'مدیر محتوا',
            'title' => 'content-manager-' . uniqid(),
            'status' => 4,
        ]);

        $user = User::create([
            'name' => 'Panel Content User',
            'email' => 'panel-content-' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
            'level' => 'panel',
            'change_password' => 1,
            'status' => 4,
        ]);

        $user->roles()->attach($role->id);

        $permission = Permission::create([
            'title' => 'content',
            'label' => 'محتوا',
            'slug' => 'content',
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

    private function makeMenuContext(User $user): array
    {
        $menu = Menu::create([
            'priority' => 1,
            'label' => 'منوی تست محتوا',
            'title' => 'content-test-menu',
            'slug' => 'content-test-menu',
            'submenu' => 1,
            'class' => 'index',
            'type' => 'site',
            'controller' => 'IndexController',
            'status' => 4,
            'user_id' => $user->id,
        ]);

        $submenu = Submenu::create([
            'priority' => 1,
            'title' => 'زیرمنوی تست محتوا',
            'label' => 'زیرمنوی تست محتوا',
            'menu_id' => $menu->id,
            'slug' => 'content-test-submenu',
            'type' => 'site',
            'status' => 4,
            'user_id' => $user->id,
        ]);

        return [$menu, $submenu];
    }

    private function makeStorePayload(Menu $menu, Submenu $submenu, array $overrides = []): array
    {
        return array_merge([
            'title' => 'محتوای تستی',
            'slug' => 'content-test-item',
            'description' => 'توضیح تستی',
            'menupanel_id' => $menu->id,
            'submenupanel_id' => $submenu->id,
            'status' => 4,
        ], $overrides);
    }

    public function test_panel_user_without_content_view_permission_gets_forbidden_on_index(): void
    {
        $user = $this->makePanelUserWithContentPermission();
        $response = $this->actingAs($user, 'panel')->get('/panel/content');
        $response->assertForbidden();
    }

    public function test_panel_user_with_content_view_permission_can_access_index(): void
    {
        $user = $this->makePanelUserWithContentPermission(['can_view' => true]);
        $response = $this->actingAs($user, 'panel')->get('/panel/content');
        $response->assertOk();
    }

    public function test_panel_user_without_content_insert_permission_gets_forbidden_on_store(): void
    {
        $user = $this->makePanelUserWithContentPermission();
        [$menu, $submenu] = $this->makeMenuContext($user);

        $response = $this->actingAs($user, 'panel')->post('/panel/content', $this->makeStorePayload($menu, $submenu));
        $response->assertForbidden();
    }

    public function test_content_store_rejects_invalid_dynamic_meta_title_format(): void
    {
        $user = $this->makePanelUserWithContentPermission(['can_insert' => true]);
        [$menu, $submenu] = $this->makeMenuContext($user);

        $payload = $this->makeStorePayload($menu, $submenu, [
            'meta_title' => 'page:نامعتبر',
        ]);

        $response = $this->actingAs($user, 'panel')->post('/panel/content', $payload);

        $response->assertSessionHasErrors('meta_title');
    }

    public function test_content_store_enforces_unique_page_marker(): void
    {
        $user = $this->makePanelUserWithContentPermission(['can_insert' => true]);
        [$menu, $submenu] = $this->makeMenuContext($user);

        Content::create([
            'title' => 'صفحه اول',
            'slug' => 'first-page',
            'meta_title' => 'page:cvc-faq',
            'menu_id' => $menu->id,
            'submenu_id' => $submenu->id,
            'status' => 4,
            'user_id' => $user->id,
        ]);

        $payload = $this->makeStorePayload($menu, $submenu, [
            'title' => 'صفحه دوم',
            'slug' => 'second-page',
            'meta_title' => 'page:cvc-faq',
        ]);

        $response = $this->actingAs($user, 'panel')->post('/panel/content', $payload);
        $response->assertSessionHasErrors('meta_title');
    }

    public function test_content_store_allows_duplicate_section_marker(): void
    {
        $user = $this->makePanelUserWithContentPermission(['can_insert' => true]);
        [$menu, $submenu] = $this->makeMenuContext($user);

        Content::create([
            'title' => 'آیتم یک',
            'slug' => 'item-one',
            'meta_title' => 'section:faq',
            'menu_id' => $menu->id,
            'submenu_id' => $submenu->id,
            'status' => 4,
            'user_id' => $user->id,
        ]);

        $payload = $this->makeStorePayload($menu, $submenu, [
            'title' => 'آیتم دو',
            'slug' => 'item-two',
            'meta_title' => 'section:faq',
        ]);

        $response = $this->actingAs($user, 'panel')->post('/panel/content', $payload);
        $response->assertOk();
    }
}

