<?php

namespace App\Console\Commands;

use App\Models\Metch;
use Illuminate\Console\Command;

class UpdateMatchResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-match-results';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update match results for matches played in the last 24 hours.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $twentyFourHoursAgo = now()->subDay();

        $matches = Metch::where('date', '>', $twentyFourHoursAgo)
                        ->where('date', '<=', now()) 
                        ->whereNull('result') 
                        ->get();

        foreach ($matches as $match) {
            $result = rand(0, 9) . ' - ' . rand(0, 9);

            $match->update(['result' => $result]);
        }

        $this->info('Match results updated successfully.');
    }
}
