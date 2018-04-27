<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Scraper;
use App\Posts;
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
    public function scrape_a_page_and_store_results_in_post()
    {
        $scraper = new Scraper();
        $scraper->storeNewPosts();
        
        $this->assertNotNull(Posts::all());
    }
}