<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $createdUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->createdUser = User::factory()->create();
    }

    /**
     * Get user by id
     * @test
     */
    public function get_one_user(): void
    {
        $response = $this->get(route('api-get-user', ['userId' => $this->createdUser->id]));
        $response->assertStatus(200);
    }

    /**
     * Get error on find user by id
     * @test
     */
    public function get_error_one_user(): void
    {
        $response = $this->get(route('api-get-user', ['userId' => 999]));
        $response->assertStatus(404);
    }

    /**
     * Get all users
     * @test
     */
    public function get_all_users(): void
    {
        $response = $this->get(route('api-get-all-users'));
        $response->assertStatus(200);
    }

    /**
     * Get all users
     * @test
     */
    public function post_new_user(): void
    {
        $fakerName = $this->faker->name;
        $fakerEmail = $this->faker->email;
        $fakerPassword = $this->faker->password;

        $response = $this->post(route('api-add-user'),[
            'name' => $fakerName,
            'email' => $fakerEmail,
            'password' => $fakerPassword
        ]);
        $response->assertStatus(201);

        $this->assertDatabaseHas('users',[
            'name' => $fakerName,
            'email' => $fakerEmail,
        ]);
    }

    /**
     * Get update users
     * @test
     */
    public function post_update_user(): void
    {
        $fakerName = $this->faker->name;
        $fakerEmail = $this->faker->email;
        $fakerPassword = $this->faker->password;

        $response = $this->post(route('api-update-user', ['userId' => $this->createdUser->id]),[
            'name' => $fakerName,
            'email' => $fakerEmail,
            'password' => $fakerPassword
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('users',[
            'name' => $fakerName,
        ]);
    }
}
