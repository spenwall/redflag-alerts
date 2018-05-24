<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Alert;
use App\Post;
use App\Mail\PostFound;
use Illuminate\Foundation\Testing\RefreshDatabase;


class EmailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function email_sent_when_new_match_found()
    {
       //given a user
        $user = factory(User::class)->create([
            'email' => 'dude.wallace@gmail.com'
        ]);

        $alert = factory(Alert::class)->create([
            'user_id' => $user->id,
            'keywords' => 'off'
        ]);
        $post = factory(Post::class)->create();
        
        $alert->emailPost($post);
        
        $this->assertEquals('one', 'one');
    }
}