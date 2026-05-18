<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DisableLegacyPanelModulesSeeder extends Seeder
{
    public function run(): void
    {
        $legacyControllers = [
            'AccountController',
            'CalendarController',
            'ChartController',
            'CompanyController',
            'FinancialController',
            'FlowController',
            'LeveluserController',
            'MinuteController',
            'OwnerController',
            'PaidController',
            'ProjectController',
            'ReceiveController',
            'SlideController',
            'TypeuserController',
            'UseraccessController',
        ];

        DB::table('submenus')
            ->where('type', 'panel')
            ->whereIn('controller', $legacyControllers)
            ->update([
                'status' => 1,
                'updated_at' => now(),
            ]);

        DB::table('permissions')
            ->whereIn('slug', [
                'account',
                'calendar',
                'chart',
                'company',
                'financial',
                'flow',
                'leveluser',
                'minute',
                'owner',
                'paid',
                'project',
                'receive',
                'slide',
                'typeuser',
                'useraccess',
            ])
            ->delete();
    }
}
