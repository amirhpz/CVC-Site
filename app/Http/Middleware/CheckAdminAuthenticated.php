<?php

namespace App\Http\Middleware;

use App\Models\Submenu;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next , $guard = null ,  $permissionType = null, $submenuSlug = null): Response
    {
        Auth::shouldUse('panel');

        if (!Auth::guard('panel')->check()) {
            return redirect()->route('login');
        }

        $user = Auth::guard('panel')->user();

        // 2. بررسی اجبار به تغییر رمز
        if (is_null($user->change_password)) {
            // اگر مسیر جاری مربوط به فرم یا ارسال تغییر رمز نیست
            if (
                !$request->routeIs('password.change.form') &&
                !$request->routeIs('password.change.submit')
            ) {
                return redirect()->route('password.change.form');
            }
        }

        // 3. اگر پارامترهای دسترسی وارد نشده باشن، مرحله بعدی اجرا بشه
        if (!$permissionType || !$submenuSlug) {
            return $next($request);
        }

        // 4. بررسی دسترسی به زیرمنو
        $submenu = Submenu::where('slug', $submenuSlug)->first();

        if (!$submenu) {
            abort(403, 'زیرمنو مورد نظر پیدا نشد.');
        }

        $roles = $user->roles()->pluck('roles.id');

        $permissionTable = Schema::hasTable('submenu_permissions') ? 'submenu_permissions' : 'submenu_permission';

        $hasPermission = DB::table($permissionTable)
            ->whereIn('role_id', $roles)
            ->where('submenu_id', $submenu->id)
            ->where($permissionType, true)
            ->exists();

        if (!$hasPermission) {
            abort(403, 'شما دسترسی لازم را ندارید.');
        }

        return $next($request);
    }
}
