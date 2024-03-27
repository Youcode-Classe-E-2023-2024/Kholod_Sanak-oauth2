<?php
//
//namespace Tests\Feature;
//
//use Illuminate\Foundation\Testing\RefreshDatabase;
//use Illuminate\Foundation\Testing\WithFaker;
//use Tests\TestCase;
//use App\Models\User; // Import the User model
//
//class UserTest extends TestCase
//{
//    use RefreshDatabase; // Use this trait to run tests with a clean database
//
//    /**
//     * Test adding a user when authenticated.
//     *
//     * @return void
//     */
//    public function test_add_user_when_authenticated()
//    {
//        $this->artisan('migrate');
//
//        // Create a user for authentication
//        $user = User::factory()->create();
//
//        // Authenticate the user
//        $this->actingAs($user, 'api');
//
//        // Data for the new user
//        $userData = [
//            'name' => 'John Doe',
//            'email' => 'john@example.com',
//            'password' => 'password123',
//            'role_id' => 2,
//        ];
//
//        // Make a POST request to add the user
//        $response = $this->postJson('/api/users', $userData); // Use postJson() for JSON requests
//
//        // Assert that the response status is 201 (Created) since the user is authenticated
//        $response->assertStatus(201);
//
//        // Assert that the response contains the user data
//        $response->assertJsonFragment($userData);
//    }
//}
