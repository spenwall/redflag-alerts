<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Alert;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AlertControllerTest extends TestCase
{
    /** @test */
    public function alert_controller_displays_alerts()
    {
        $user = factory(User::class)->create();
        $alert = factory(Alert::class)->create([
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
        $response->assertSee($alert->keywords);
    }
}