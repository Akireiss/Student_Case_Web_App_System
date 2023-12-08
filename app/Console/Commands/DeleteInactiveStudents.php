<?php

namespace App\Console\Commands;

use App\Models\Students;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteInactiveStudents extends Command
{
    protected $signature = 'students:delete-inactive';

    protected $description = 'Delete inactive students older than 5 years.';

    public function handle()
    {
        $fiveYearsAgo = Carbon::now()->subYears(5);

        Students::where('status', 1)
            ->where('updated_at', '<', $fiveYearsAgo)
            ->forceDelete();

        $this->info('Inactive students older than 5 years have been forcefully deleted.');
    }
}
