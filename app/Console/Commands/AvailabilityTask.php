<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\AvailabilityController;
use Illuminate\Console\Command;

class AvailabilityTask extends Command
{
    protected AvailabilityController $availabilityController;
    protected $signature = 'availability:task {tier}';
    protected $description = 'Command description';

    public function __construct(AvailabilityController $availabilityController)
    {
        parent::__construct();

        $this->availabilityController = $availabilityController;
    }

    public function handle(): int
    {
        $this->availabilityController->CheckAvailability($this->argument('tier'));

        return Command::SUCCESS;
    }
}
