<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\Menu;
use App\Models\Submenu;
use App\Models\User;
use Illuminate\Database\Seeder;

class CvcDynamicContentSeeder extends Seeder
{
    public function run(): void
    {
        $userId = User::query()->value('id');
        $menuId = Menu::query()->where('type', 'site')->where('status', 4)->value('id');
        $submenuId = Submenu::query()->where('type', 'site')->where('status', 4)->value('id');

        if (!$userId || !$menuId || !$submenuId) {
            return;
        }

        $pageKeys = [
            'page:cvc-faq' => 'پیکربندی صفحه FAQ',
            'page:cvc-domains' => 'پیکربندی صفحه حوزه‌ها',
            'page:cvc-investment' => 'پیکربندی صفحه سرمایه‌گذاری',
            'page:cvc-investment-process' => 'پیکربندی صفحه فرایند سرمایه‌گذاری',
        ];

        foreach ($pageKeys as $metaTitle => $title) {
            Content::query()->updateOrCreate(
                ['meta_title' => $metaTitle],
                [
                    'title' => $title,
                    'slug' => null,
                    'description' => 'این رکورد برای مدیریت محتوای داینامیک CVC استفاده می‌شود.',
                    'menu_id' => $menuId,
                    'submenu_id' => $submenuId,
                    'status' => 4,
                    'user_id' => $userId,
                ]
            );
        }

        $sectionKeys = [
            'section:faq' => 'سوالات متداول',
            'section:domain' => 'حوزه‌های سرمایه‌گذاری',
            'section:investment' => 'بلاک‌های صفحه سرمایه‌گذاری',
            'section:investment-process' => 'بلاک‌های صفحه فرایند سرمایه‌گذاری',
        ];

        foreach ($sectionKeys as $metaTitle => $title) {
            Content::query()->firstOrCreate(
                ['meta_title' => $metaTitle, 'title' => $title],
                [
                    'slug' => null,
                    'description' => 'آیتم قابل ویرایش برای محتوای داینامیک CVC.',
                    'menu_id' => $menuId,
                    'submenu_id' => $submenuId,
                    'status' => 4,
                    'user_id' => $userId,
                ]
            );
        }
    }
}

