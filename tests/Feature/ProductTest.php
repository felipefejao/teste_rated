<?php

namespace Tests\Feature;


use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $createdProduct;

    protected function setUp(): void
    {
        parent::setUp();
        $this->createdProduct = Product::factory()->create();
    }

    /**
     * Get user by id
     * @test
     */
    public function get_one_product(): void
    {
        $response = $this->get(route('api-get-product', ['productId' => $this->createdProduct->id]));
        $response->assertStatus(200);
    }

    /**
     * Get error on find user by id
     * @test
     */
    public function get_error_one_product(): void
    {
        $response = $this->get(route('api-get-product', ['productId' => 999]));
        $response->assertStatus(404);
    }

    /**
     * Get all users
     * @test
     */
    public function get_all_products(): void
    {
        $response = $this->get(route('api-get-all-products'));
        $response->assertStatus(200);
    }

    /**
     * Get all users
     * @test
     */
    public function post_new_product(): void
    {
        $fakerDescription = $this->faker->text(50);
        $fakerQuantity = $this->faker->numerify;

        $response = $this->post(route('api-add-product'),[
            'description' => $fakerDescription,
            'quantity' => $fakerQuantity,
        ]);
        $response->assertStatus(201);

        $this->assertDatabaseHas('products',[
            'description' => $fakerDescription,
            'quantity' => $fakerQuantity,
        ]);
    }

    /**
     * Get update users
     * @test
     */
    public function post_update_product(): void
    {
        $fakerDescription = $this->faker->text(50);
        $fakerQuantity = $this->faker->numerify;

        $response = $this->post(route('api-update-product', ['productId' => $this->createdProduct->id]),[
            'description' => $fakerDescription,
            'quantity' => $fakerQuantity,
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('products',[
            'description' => $fakerDescription,
        ]);
    }
}
