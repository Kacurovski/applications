<?php

namespace App\Console\Commands;

use App\Models\Vehicle;
use Illuminate\Console\Command;

class CleanUpExpiredVehicles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleanup:expired-vehicles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete soft-deleted records and vehicles with expired insurance_date.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Vehicle::onlyTrashed()
            ->where('insurance_date', '<', now())
            ->forceDelete();

        $this->info('Clean-up completed successfully.');
    }
}
