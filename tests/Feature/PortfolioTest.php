<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PortfolioTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_get_portfolios()
    {

    }

    public function test_get_no_active_portfolios()
    {

    }

    public function test_upload_portfolio_images()
    {

    }

    public function test_create_portfolio_with_bad_data()
    {

    }

    public function test_unauthoruized_user_create_portfolio()
    {

    }
    
    public function test_update_user_portfolio()
    {

    }

    public function test_update_other_user_portfolio()
    {

    }

    public function test_update_portfolio_with_role_admin()
    {

    }

    public function test_delete_portfolio()
    {

    }

    public function test_delete_other_user_portfolio()
    {

    }

    public function test_delete_portfolio_with_role_admin()
    {
        
    }
}
