<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Scraper;
use App\Post;

class ScraperCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraper:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $scraper = new Scraper();
        $posts = Post::deleteAll();
        $scraper->storeNewPosts();
    }
}
