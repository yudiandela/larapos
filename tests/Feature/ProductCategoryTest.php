<?php

namespace Tests\Feature;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_categories_screen_can_be_rendered()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/categories');

        $response->assertOk()
            ->assertSeeText($user->name);
    }

    public function test_can_store_a_new_product_category()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/categories', [
            'title' => 'Makanan',
            'description' => 'Makanan instan cepat saji yang disajikan saat anda kelaparan',
        ]);

        $response->assertCreated();
    }

    public function test_validate_store_a_new_product_category_title_required()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/categories', [
            'title' => '',
        ]);

        $response->assertSessionHasErrors();
    }

    public function test_validate_store_a_new_product_category_title_min_3_char()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/categories', [
            'title' => 'as',
        ]);

        $response->assertSessionHasErrors();
    }

    public function test_validate_store_a_new_product_category_title_is_string()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/categories', [
            'title' => 123456789,
        ]);

        $response->assertSessionHasErrors();
    }

    public function test_validate_store_a_new_product_category_which_is_not_title_is_not_required()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/categories', [
            'title' => 'Minuman'
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_visit_detail_product_category()
    {
        $user = User::factory()->create();
        $category = ProductCategory::factory()->create();

        $response = $this->actingAs($user)->get('/categories');

        $response->assertOk()
            ->assertSeeText($category->title);
    }

    public function test_update_product_category()
    {
        $user = User::factory()->create();
        $category = ProductCategory::factory()->create();

        $response = $this->actingAs($user)->put('/categories/' . $category->id, [
            'title' => 'Minuman'
        ]);

        $response->assertOk();
    }

    public function test_delete_product_category()
    {
        $user = User::factory()->create();
        $category = ProductCategory::factory()->create();

        $response = $this->actingAs($user)->delete('/categories/' . $category->id);

        $response->assertOk();
    }
}
