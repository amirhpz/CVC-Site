<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class PanelAuthorizationGateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Route::middleware('web')->get('/__test/panel-can-access', function () {
            abort_unless(auth()->user()?->can('can-access', ['menupanel', 'view']), 403);
            return response()->json(['ok' => true]);
        });
    }

    public function test_user_without_permission_gets_forbidden(): void
    {
        $role = Role::create([
            'title_fa' => 'کارشناس',
            'title' => 'expert',
            'status' => 4,
        ]);

        $user = User::create([
            'name' => 'No Access User',
            'email' => 'no-access@example.com',
            'password' => bcrypt('password'),
            'level' => 'panel',
        ]);

        $user->roles()->attach($role->id);

        $response = $this->actingAs($user)->get('/__test/panel-can-access');

        $response->assertForbidden();
    }

    public function test_superadmin_user_can_access(): void
    {
        $role = Role::create([
            'title_fa' => 'ادمین',
            'title' => 'superadmin',
            'status' => 4,
        ]);

        $user = User::create([
            'name' => 'Allowed User',
            'email' => 'allowed@example.com',
            'password' => bcrypt('password'),
            'level' => 'panel',
        ]);

        $user->roles()->attach($role->id);

        $response = $this->actingAs($user)->get('/__test/panel-can-access');

        $response->assertOk();
    }
}
