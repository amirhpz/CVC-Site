<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Emploee;
use App\Models\Product;
use App\Models\Content;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CvcCareerAndNewsFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_news_page_lists_published_posts(): void
    {
        if (!Schema::hasTable('posts')) {
            $this->markTestSkipped('posts table is not available in this environment.');
        }

        Post::create([
            'title' => 'خبر تستی',
            'slug' => 'test-news-item',
            'description' => 'توضیحات کوتاه خبر تستی',
            'full_description' => 'متن کامل خبر تستی',
            'status' => 4,
        ]);

        $response = $this->get('/news');

        $response->assertOk();
        $response->assertSee('خبر تستی');
    }

    public function test_single_news_page_loads_by_slug(): void
    {
        if (!Schema::hasTable('posts')) {
            $this->markTestSkipped('posts table is not available in this environment.');
        }

        Post::create([
            'title' => 'خبر تک صفحه',
            'slug' => 'single-news-item',
            'description' => 'خلاصه خبر تک صفحه',
            'full_description' => 'متن کامل خبر تک صفحه',
            'status' => 4,
        ]);

        $response = $this->get('/news/single-news-item');

        $response->assertOk();
        $response->assertSee('خبر تک صفحه');
    }

    public function test_team_page_lists_active_members(): void
    {
        Emploee::create([
            'fullname' => 'عضو تستی تیم',
            'slug' => 'test-team-member',
            'side' => 'تحلیلگر',
            'status' => 4,
            'priority' => 1,
        ]);

        $response = $this->get('/team');

        $response->assertOk();
        $response->assertSee('عضو تستی تیم');
    }

    public function test_team_member_page_loads_by_slug(): void
    {
        Emploee::create([
            'fullname' => 'پروفایل تستی',
            'slug' => 'profile-test-member',
            'side' => 'مدیر پژوهش',
            'description' => 'توضیح عضو تستی',
            'status' => 4,
            'priority' => 1,
        ]);

        $response = $this->get('/team/profile-test-member');

        $response->assertOk();
        $response->assertSee('پروفایل تستی');
        $response->assertSee('توضیح عضو تستی');
    }

    public function test_about_page_lists_team_members_dynamically(): void
    {
        Emploee::create([
            'fullname' => 'عضو تستی درباره ما',
            'slug' => 'about-test-member',
            'side' => 'تحلیلگر ارشد',
            'description' => 'توضیح تستی برای بخش درباره ما',
            'status' => 4,
            'priority' => 1,
        ]);

        $response = $this->get('/about');

        $response->assertOk();
        $response->assertSee('عضو تستی درباره ما');
    }

    public function test_portfolio_page_lists_active_projects(): void
    {
        Product::create([
            'title' => 'پروژه تستی پرتفوی',
            'slug' => 'portfolio-test-project',
            'sub_title' => 'فین‌تک',
            'description' => 'توضیح پروژه تستی',
            'status' => 4,
            'product_type' => 'contract',
        ]);

        $response = $this->get('/portfolio');

        $response->assertOk();
        $response->assertSee('پروژه تستی پرتفوی');
    }

    public function test_home_page_lists_dynamic_blocks(): void
    {
        Product::create([
            'title' => 'پروژه تستی خانه',
            'slug' => 'home-test-project',
            'description' => 'توضیح پروژه صفحه خانه',
            'status' => 4,
            'product_type' => 'contract',
        ]);

        Emploee::create([
            'fullname' => 'عضو تستی خانه',
            'slug' => 'home-test-member',
            'side' => 'تحلیلگر',
            'description' => 'توضیح عضو صفحه خانه',
            'status' => 4,
            'priority' => 1,
        ]);

        Post::create([
            'title' => 'خبر تستی خانه',
            'slug' => 'home-test-news',
            'description' => 'توضیح خبر صفحه خانه',
            'status' => 4,
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('پروژه تستی خانه');
        $response->assertSee('عضو تستی خانه');
        $response->assertSee('خبر تستی خانه');
    }

    public function test_faq_page_renders_dynamic_content_items(): void
    {
        [$menuId, $submenuId] = $this->createContentMenuContext();

        Content::create([
            'title' => 'FAQ تستی',
            'meta_title' => 'page:cvc-faq',
            'description' => 'توضیح FAQ تستی',
            'menu_id' => $menuId,
            'submenu_id' => $submenuId,
            'status' => 4,
        ]);
        Content::create([
            'title' => 'سوال تستی',
            'meta_title' => 'section:faq',
            'description' => 'پاسخ تستی',
            'menu_id' => $menuId,
            'submenu_id' => $submenuId,
            'status' => 4,
        ]);

        $response = $this->get('/faq');
        $response->assertOk();
        $response->assertSee('FAQ تستی');
        $response->assertSee('سوال تستی');
    }

    public function test_domains_page_renders_dynamic_content_items(): void
    {
        [$menuId, $submenuId] = $this->createContentMenuContext();

        Content::create([
            'title' => 'دامنه تستی',
            'meta_title' => 'page:cvc-domains',
            'description' => 'توضیح دامنه تستی',
            'menu_id' => $menuId,
            'submenu_id' => $submenuId,
            'status' => 4,
        ]);
        Content::create([
            'title' => 'حوزه تستی',
            'meta_title' => 'section:domain',
            'description' => 'شرح حوزه تستی',
            'menu_id' => $menuId,
            'submenu_id' => $submenuId,
            'status' => 4,
        ]);

        $response = $this->get('/domains');
        $response->assertOk();
        $response->assertSee('دامنه تستی');
        $response->assertSee('حوزه تستی');
    }

    public function test_investment_pages_render_dynamic_content_items(): void
    {
        [$menuId, $submenuId] = $this->createContentMenuContext();

        Content::create([
            'title' => 'سرمایه‌گذاری تستی',
            'meta_title' => 'page:cvc-investment',
            'description' => 'توضیح سرمایه‌گذاری تستی',
            'menu_id' => $menuId,
            'submenu_id' => $submenuId,
            'status' => 4,
        ]);
        Content::create([
            'title' => 'فرایند سرمایه‌گذاری تستی',
            'meta_title' => 'page:cvc-investment-process',
            'description' => 'توضیح فرایند سرمایه‌گذاری تستی',
            'menu_id' => $menuId,
            'submenu_id' => $submenuId,
            'status' => 4,
        ]);

        Content::create([
            'title' => 'آیتم سرمایه‌گذاری',
            'meta_title' => 'section:investment',
            'description' => 'شرح آیتم سرمایه‌گذاری',
            'menu_id' => $menuId,
            'submenu_id' => $submenuId,
            'status' => 4,
        ]);
        Content::create([
            'title' => 'گام فرایند',
            'meta_title' => 'section:investment-process',
            'description' => 'شرح گام فرایند',
            'menu_id' => $menuId,
            'submenu_id' => $submenuId,
            'status' => 4,
        ]);

        $investmentResponse = $this->get('/investment');
        $investmentResponse->assertOk();
        $investmentResponse->assertSee('سرمایه‌گذاری تستی');
        $investmentResponse->assertSee('آیتم سرمایه‌گذاری');

        $processResponse = $this->get('/investment-process');
        $processResponse->assertOk();
        $processResponse->assertSee('فرایند سرمایه‌گذاری تستی');
        $processResponse->assertSee('گام فرایند');
    }

    private function createContentMenuContext(): array
    {
        $user = User::create([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => 'password',
            'status' => 4,
        ]);

        $menuId = \DB::table('menus')->insertGetId([
            'priority' => 1,
            'label' => 'منو تست',
            'title' => 'Test Menu',
            'slug' => 'test-menu',
            'submenu' => 1,
            'type' => 'site',
            'status' => 4,
            'user_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $submenuId = \DB::table('submenus')->insertGetId([
            'priority' => 1,
            'title' => 'زیرمنو تست',
            'label' => 'Test Submenu',
            'menu_id' => $menuId,
            'slug' => 'test-submenu',
            'type' => 'site',
            'status' => 4,
            'user_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return [$menuId, $submenuId];
    }

    public function test_career_application_is_stored_successfully(): void
    {
        Storage::fake('public');

        $response = $this->post('/career/apply', [
            'first_name' => 'علی',
            'last_name' => 'رضایی',
            'national_code' => '1234567890',
            'birth_date' => '1995-01-01',
            'gender' => 'male',
            'marital_status' => 'single',
            'email' => 'career@example.com',
            'phone' => '09123456789',
            'city' => 'تهران',
            'province' => 'تهران',
            'position' => 'investment_analyst',
            'expected_salary' => '50000000',
            'availability' => 'immediate',
            'resume' => UploadedFile::fake()->create('cv.pdf', 200, 'application/pdf'),
            'terms' => '1',
        ]);

        $response->assertRedirect('/career');
        $response->assertSessionHas('career_success', true);

        $this->assertDatabaseHas('career_applications', [
            'email' => 'career@example.com',
            'position' => 'investment_analyst',
        ]);
    }

    public function test_career_application_validation_blocks_invalid_submission(): void
    {
        $response = $this->post('/career/apply', []);

        $response->assertSessionHasErrors([
            'first_name',
            'last_name',
            'national_code',
            'birth_date',
            'gender',
            'marital_status',
            'email',
            'phone',
            'city',
            'province',
            'position',
            'expected_salary',
            'availability',
            'resume',
            'terms',
        ]);
    }

    public function test_contact_message_is_stored_successfully(): void
    {
        $response = $this->post('/contact', [
            'first_name' => 'رضا',
            'last_name' => 'محمدی',
            'email' => 'contact@example.com',
            'phone' => '09121234567',
            'subject' => 'درخواست مشاوره',
            'message' => 'سلام، برای همکاری و مشاوره تماس می‌گیرم.',
        ]);

        $response->assertRedirect('/contact');
        $response->assertSessionHas('contact_success', true);

        $this->assertDatabaseHas('contact_messages', [
            'email' => 'contact@example.com',
            'subject' => 'درخواست مشاوره',
        ]);
    }

    public function test_contact_message_validation_blocks_invalid_submission(): void
    {
        $response = $this->post('/contact', []);

        $response->assertSessionHasErrors([
            'first_name',
            'last_name',
            'email',
            'phone',
            'subject',
            'message',
        ]);
    }

    public function test_legacy_single_news_redirects_to_news_when_empty(): void
    {
        $response = $this->get('/single-news');
        $response->assertRedirect('/news');
    }

    public function test_legacy_single_news_redirects_to_latest_post_when_available(): void
    {
        Post::create([
            'title' => 'خبر قدیمی',
            'slug' => 'old-news',
            'status' => 4,
            'created_at' => now()->subMinute(),
        ]);

        Post::create([
            'title' => 'خبر جدید',
            'slug' => 'latest-news',
            'status' => 4,
            'created_at' => now(),
        ]);

        $response = $this->get('/single-news');
        $response->assertRedirect('/news/latest-news');
    }

    public function test_legacy_team_member_redirects_to_team_when_empty(): void
    {
        $response = $this->get('/team-member');
        $response->assertRedirect('/team');
    }

    public function test_legacy_team_member_redirects_to_first_member_when_available(): void
    {
        Emploee::create([
            'fullname' => 'بدون اسلاگ',
            'status' => 4,
            'priority' => 1,
        ]);

        Emploee::create([
            'fullname' => 'عضو دارای اسلاگ',
            'slug' => 'member-with-slug',
            'status' => 4,
            'priority' => 2,
        ]);

        $response = $this->get('/team-member');
        $response->assertRedirect('/team');

        Emploee::query()->where('priority', 1)->update(['slug' => 'first-member']);
        $response = $this->get('/team-member');
        $response->assertRedirect('/team/first-member');
    }

    public function test_dynamic_pages_show_empty_state_messages(): void
    {
        $this->get('/home')->assertStatus(404);

        $this->get('/')->assertOk()
            ->assertSee('پروژه‌ای برای نمایش ثبت نشده است.')
            ->assertSee('عضو تیمی برای نمایش ثبت نشده است.')
            ->assertSee('خبری برای نمایش ثبت نشده است.');

        $this->get('/about')->assertOk()
            ->assertSee('در حال حاضر اعضای تیم برای نمایش ثبت نشده‌اند.');

        $this->get('/team')->assertOk()
            ->assertSee('در حال حاضر عضو فعالی برای نمایش ثبت نشده است.');

        $this->get('/portfolio')->assertOk()
            ->assertSee('در حال حاضر پروژه‌ای برای نمایش ثبت نشده است.');

        $this->get('/news')->assertOk()
            ->assertSee('هنوز خبری ثبت نشده است');
    }
}
