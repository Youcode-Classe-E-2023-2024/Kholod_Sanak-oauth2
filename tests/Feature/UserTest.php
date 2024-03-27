<?php

namespace Tests\Feature;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
//    use RefreshDatabase;


    public function test_show_user_when_authenticated()
    {
        // Create an admin user
        $adminRole = Role::where('name', 'admin')->first();
        $adminUser = User::factory()->create(['role_id' => $adminRole->id]);

        // Authenticate the admin user
        $this->actingAs($adminUser, 'api');

        // Create another user for testing
        $defaultRole = Role::where('name', 'user')->first();
        $userToShow = User::factory()->create(['role_id' => $defaultRole->id]);

        // Make a GET request to show the user
        $response = $this->getJson("/api/user/{$userToShow->id}");

        // Assert that the response status is 200 (OK) since the user is authenticated
        $response->assertStatus(200);

        // Assert that the response contains the user data
        $response->assertJsonFragment($userToShow->toArray());
    }

}
