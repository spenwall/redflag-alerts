<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Alert;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ControllerTest extends TestCase
{
    /** @test */
    public function alert_controller_displays_alerts()
    {
        $user = factory(User::class)->create();
        $alert = factory(Alert::class)->create([
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user)->get('/alerts');

        $response->assertStatus(200);
        $response->assertSee($alert->keywords);
    }

    /** @test */
    public function alerts_create_page_displays_form()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/alerts/create');

        $response->assertSee('Add a new Alert');
        $response->assertSee('<form method="POST"');
    }
}
