<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\AvailabilityController;
use Illuminate\Console\Command;

class AvailabilityTask extends Command
{
    protected AvailabilityController $availabilityController;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'availability:task';

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
    public function __construct(AvailabilityController $availabilityController)
    {
        parent::__construct();

        $this->availabilityController = $availabilityController;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->availabilityController->CheckAvailability();

        return Command::SUCCESS;
    }
}
