<?php

namespace Tests\Feature;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = User::factory()->create();

        $response = $this->get("/users/{$user->id}/achievements");

        $response->assertStatus(200);
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_post_request()
    {
        $user = User::factory()->create();

        $response = $this->post("/users/{$user->id}/achievements");

        $response->assertStatus(404);
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_misisng_request()
    {
        $user = User::factory()->create();

        $response = $this->json('GET' , "/users/{$user->id}/achievements");

        $response->assertJson(fn (AssertableJson $json) =>
        $json->hasAll('unlocked_achievements','next_available_achievements','current_badge','next_badge','remaing_to_unlock_next_badge')
        );
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_jsonType_request()
    {
        $user = User::factory()->create();

        $response = $this->json('GET' , "/users/{$user->id}/achievements");

        $response->assertJson(fn (AssertableJson $json) =>
        $json->hasAll('unlocked_achievements','next_available_achievements','current_badge','next_badge','remaing_to_unlock_next_badge')
        );
        $response->assertJson(fn (AssertableJson $json) =>
        $json->whereType('unlocked_achievements', 'array')
            ->whereAllType([
                'next_available_achievements' => 'array',
                'current_badge' => 'string',
                'next_badge' => 'string',
                'remaing_to_unlock_next_badge' => 'integer'

            ])
        );
    }
}
