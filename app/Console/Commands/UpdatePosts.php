<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Post;
use App\Scraper;
use App\Alert;
use Carbon\Carbon;

class UpdatePosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redflag:update-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This calls the update posts and '.
                            'then searches all alerts for a match '.
                            'with the new posts';

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
        $latestDate = Carbon::now()->subDays(2);
        //get last updated post
        if (Post::all()->isNotEmpty()) {
            $last = Post::orderBy('id', 'desc')->first();
            $latestDate = $last->created_at;
        }
        //scraper update
        $scraper = new Scraper();
        $scraper->storeNewPosts();
        //search alerts
        $allAlerts = Alert::all();

        foreach ($allAlerts as $alert) {
            $alert->searchForNewPosts($latestDate->toDateTimeString());
        }
    }
}
