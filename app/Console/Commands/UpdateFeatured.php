<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;

class UpdateFeatured extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'featured:update';

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
        $sorted_pets = DB::table('pets')->orderBy('impressions')->take(4)->get();
        DB::table('featured_relation')->delete();
        foreach ($sorted_pets as $pet) {
            DB::table('featured_relation')->insert([ 'pet_id' => $pet->id ]);
        }
    }
}
