<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_get_own_comments()
    {

    }

    public function test_get_other_user_comments()
    {

    }

    public function test_get_comments_with_role_admin()
    {

    }

    public function test_create_comment()
    {

    }

    public function test_create_comment_with_bad_data()
    {

    }

    public function test_update_own_comment()
    {

    }

    public function test_update_other_user_comments()
    {

    }

    public function test_update_comment_with_role_admin()
    {

    }

    public function test_delete_user_comment()
    {

    }

    public function test_delete_other_user_comment()
    {

    }

    public function test_delete_comment_with_role_admin()
    {

    }

    public function test_allow_comment_to_publish()
    {

    }

    public function test_visablity_other_user_comment()
    {
        
    }

}
