<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            MenuSeeder::class,
            SubmenuSeeder::class,
            EnsureCvcPortfolioTeamAccessSeeder::class,
            EnsureCvcNewsCmsAccessSeeder::class,
            EnsureCvcInboundCmsAccessSeeder::class,
            EnsureCvcSectionCmsAccessSeeder::class,
            EnsureCvcPageCmsAccessSeeder::class,
            DisableLegacyWalletTransactionAccessSeeder::class,
            DisableLegacyPanelModulesSeeder::class,
            DisableRemovedCvcAdminItemsSeeder::class,
            CvcDynamicContentSeeder::class,
//            StateSeeder::class,
//            citySeeder::class,
        ]);
    }
}
