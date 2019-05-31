<?php

namespace App\Console\Commands;

use App\Models\Spot_ipadress;
use Illuminate\Console\Command;

class DeleteSpotIps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deletespotips';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Her gün düzenli olarak bakan ipleri silecek';

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
        Spot_ipadress::truncate();
    }
}
