<?php

namespace App\Http\ViewComposers;

use App\Models\Invoice;
use App\Models\Submenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use App\Models\Menu;
use App\Models\Version;

class SiteMenuComposer
{
    public function compose(View $view)
    {
        $url = request()->segments();

        $menus = collect();
        $submenus = collect();
        $thispage = null;

        if (Schema::hasTable('menus')) {
            $menus = Menu::whereStatus(4)->whereType('site')->orderBy('priority')->get();
        }
        if (Schema::hasTable('submenus')) {
            $submenus = Submenu::whereStatus(4)->whereType('site')->get();
        }

        if (Schema::hasTable('mega_menus')) {
            $megamenus = DB::table('mega_menus')->get();
            $megacounts = DB::table('mega_menus')
                ->selectRaw('COUNT(*) as count, menu_id')
                ->groupBy('menu_id')
                ->get();
        } else {
            $megamenus = collect();
            $megacounts = collect();
        }

        if (count($url) === 1 && Schema::hasTable('menus')) {
            $thispage = Menu::whereSlug($url[0])->first();
        } elseif (count($url) > 1 && Schema::hasTable('submenus')) {
            $thispage = Submenu::whereSlug($url[1])->first();
        } elseif (Schema::hasTable('menus')) {
            $thispage = Menu::whereSlug('/')->first();
        }

        $cartCount = 0;
        if (Auth::check() && Schema::hasTable('invoices')) {
            $cartCount = Invoice::where('user_id', Auth::id())
                ->where(function ($q) {
                    $q->whereNull('price_status')
                        ->orWhere('price_status', '!=', 4);
                })
                ->count();
        }

        $view->with([
            'url' => $url,
            'menus' => $menus,
            'submenus' => $submenus,
            'megamenus' => $megamenus,
            'megacounts' => $megacounts,
            'thispage' => $thispage,
            'cartCount' => $cartCount,
        ]);
    }
}
