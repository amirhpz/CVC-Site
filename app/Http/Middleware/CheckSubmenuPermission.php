<?php

namespace App\Http\Middleware;

use App\Models\Submenu;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class CheckSubmenuPermission
{

     public function handle(Request $request, Closure $next, $permissionType, $submenuSlug)
    {
        Auth::shouldUse('panel');

        $user = Auth::guard('panel')->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $roles = $user->roles()->pluck('roles.id');

        $submenu = Submenu::where('slug', $submenuSlug)->first();

        if (!$submenu) {
            abort(403, 'زیرمنو مورد نظر پیدا نشد.');
        }

        $permissionTable = Schema::hasTable('submenu_permissions') ? 'submenu_permissions' : 'submenu_permission';

        $access = DB::table($permissionTable)
            ->whereIn('role_id', $roles)
            ->where('submenu_id', $submenu->id)
            ->where($permissionType, true)
            ->exists();

        if (!$access) {
            abort(403, 'شما دسترسی لازم را ندارید.');
        }

        return $next($request);
    }
}
