<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Scraper;
use App\User;
use App\Alert;
use SebastianBergmann\Comparator\Factory;

class ScraperTest extends TestCase
{
    /** @test */
    public function can_create_a_scraper()
    {
        $scraper = new Scraper();

        $this->assertInstanceOf(Scraper::class, $scraper);
    }

    /** @test */
    public function scraper_can_search_for_the_off_keyword_for_the_main_page()
    {
        $scraper = new Scraper();

        $results = $scraper->searchPageForKeywords('off');

        $this->assertNotEmpty($results);
    }

    /** @test */
    public function scraper_can_search_all_user_alerts_for_main_page()
    {
        $user = factory(User::class)->create();
        $alerts = factory(Alert::class)->create([
            'user_id' => $user->id,
            'keywords' => 'off',
        ]);
        $alerts = factory(Alert::class)->create([
            'user_id' => $user->id,
            'keywords' => 'free',
        ]);

        $scraper = new Scraper();
        
        $results = $scraper->searchUserAlerts($user);

        $this->assertNotEmpty($results);
    }
}
