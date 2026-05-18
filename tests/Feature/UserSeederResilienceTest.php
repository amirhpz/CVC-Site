<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserSeederResilienceTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_seeder_can_run_standalone_and_create_required_role(): void
    {
        $this->artisan('db:seed', ['--class' => 'UserSeeder'])->assertExitCode(0);

        $this->assertDatabaseHas('roles', [
            'id' => 1,
            'title' => 'superadmin',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'hosseindbk@gmail.com',
            'role_id' => 1,
        ]);

        $user = User::query()->where('email', 'hosseindbk@gmail.com')->first();
        $this->assertNotNull($user);
        $this->assertTrue($user->roles()->where('roles.id', 1)->exists());
    }
}
