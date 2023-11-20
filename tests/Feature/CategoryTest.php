<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_get_categories()
    {

    }

    public function test_create_category_with_bad_data()
    {

    }

    public function test_create_category()
    {

    }

    public function test_create_with_nested_category_with_bad_data()
    {

    }

    public function test_create_with_nested_category()
    {
        
    }

    public function test_update_category_with_bad_data() 
    {

    }

    public function test_update_category() 
    {

    }

    public function test_find_category_with_not_exists_id()
    {

    }

    public function test_find_category()
    {

    }

    public function test_category_delete_with_not_exists_id()
    {

    }

    public function test_category_delete()
    {

    }

}
