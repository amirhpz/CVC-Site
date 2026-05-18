<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class PanelAuthProtectionTest extends TestCase
{
    public function test_guest_is_redirected_from_panel_dashboard_to_login(): void
    {
        $response = $this->get('/panel');

        $response->assertRedirect(route('login'));
    }

    public function test_guest_is_redirected_from_panel_resource_to_login(): void
    {
        $response = $this->get('/panel/menupanel');

        $response->assertRedirect(route('login'));
    }

    public function test_web_guard_user_can_still_access_login_page(): void
    {
        $user = new User();
        $user->id = 999999;
        $user->email = 'web-guard-only@example.com';
        $user->password = bcrypt('secret');

        $response = $this->actingAs($user, 'web')->get('/login');

        $response->assertOk();
    }

    public function test_removed_web_payment_routes_return_not_found(): void
    {
        $this->get('/payment.callback')->assertNotFound();
        $this->get('/payment-success')->assertNotFound();
        $this->get('/payment-failed')->assertNotFound();
        $this->post('/payment')->assertNotFound();
    }

    public function test_removed_api_wallet_and_payment_routes_return_not_found(): void
    {
        $this->get('/api/v1/wallet/backtoapp')->assertNotFound();
        $this->get('/api/v1/wallet/result')->assertNotFound();
        $this->get('/api/v1/payment/payback')->assertNotFound();
        $this->get('/api/v1/payment/result')->assertNotFound();
        $this->post('/api/v1/product_payment')->assertNotFound();
        $this->post('/api/v1/invoice')->assertNotFound();
        $this->post('/api/v1/setinvoice')->assertNotFound();
        $this->get('/api/v1/order')->assertNotFound();
        $this->get('/api/v1/showinvoice')->assertNotFound();
        $this->get('/api/v1/getcontract')->assertNotFound();
        $this->get('/api/v1/getarticle')->assertNotFound();
        $this->get('/api/v1/workshops')->assertNotFound();
        $this->get('/api/v1/index')->assertNotFound();
        $this->post('/api/v1/workshopsign')->assertNotFound();
    }
}
