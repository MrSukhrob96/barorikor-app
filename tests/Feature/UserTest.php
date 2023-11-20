<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_get_users()
    {

    }

    public function test_create_user_with_bad_data()
    {

    }

    public function test_create_user()
    {

    }

    public function test_update_user_with_bad_data()
    {

    }

    public function test_update_user()
    {

    }

    public function test_upload_avatar()
    {

    }

    public function test_find_not_exists_user()
    {

    }

    public function test_find_user()
    {

    }

    public function test_delete_user_with_role_admin()
    {
        
    }

    public function test_delete_user()
    {

    }
}
