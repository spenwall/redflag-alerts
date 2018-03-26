<?php 

use Tests\TestCase;
use App\Alert;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AlertTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_a_alert()
    {
        $alert = new Alert();

        $this->assertInstanceOf(Alert::class, $alert);
    }

    /** @test */
    public function can_add_an_Alert_to_a_user()
    {
        $user = factory(User::class)->create();

        $Alert = factory(Alert::class)->create([
            'user_id' => $user->id,
        ]);

        $userAlert = $user->alerts->first();

        $this->assertNotEmpty($userAlert->name);
        $this->assertNotEmpty($userAlert->keywords);

    } 
}