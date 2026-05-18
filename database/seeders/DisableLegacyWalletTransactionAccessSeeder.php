<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DisableLegacyWalletTransactionAccessSeeder extends Seeder
{
    public function run(): void
    {
        $legacySlugs = [
            'wallet',
            'transaction',
            'payment',
            'payment.callback',
            'payment-success',
            'payment-failed',
            'wallet_payment_result',
            'product_payment',
            'payment_result',
            'backtoapp',
        ];

        $legacyControllers = [
            'WalletController',
            'TransactionController',
        ];

        DB::table('submenus')
            ->where('type', 'panel')
            ->where(function ($query) use ($legacySlugs, $legacyControllers) {
                $query->whereIn('slug', $legacySlugs)
                    ->orWhereIn('title', $legacySlugs)
                    ->orWhereIn('controller', $legacyControllers);
            })
            ->update([
                'status' => 0,
                'updated_at' => now(),
            ]);

        DB::table('menus')
            ->where('type', 'panel')
            ->where(function ($query) use ($legacySlugs, $legacyControllers) {
                $query->whereIn('slug', $legacySlugs)
                    ->orWhereIn('title', $legacySlugs)
                    ->orWhereIn('controller', $legacyControllers);
            })
            ->update([
                'status' => 0,
                'updated_at' => now(),
            ]);

        DB::table('permissions')
            ->where(function ($query) use ($legacySlugs) {
                $query->whereIn('slug', $legacySlugs)
                    ->orWhereIn('title', $legacySlugs);
            })
            ->update([
                'updated_at' => now(),
            ]);
    }
}

