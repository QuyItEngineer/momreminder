<?php

namespace App\Console\Commands;

use App\Contracts\RemindService;
use Illuminate\Console\Command;

class RemindCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check list campaign and send remind';
    /**
     * @var RemindService
     * @author vuldh <vuldh@nal.vn>
     */
    private $remindService;

    /**
     * Create a new command instance.
     *
     * @param RemindService $remindService
     */
    public function __construct(RemindService $remindService)
    {
        parent::__construct();
        $this->remindService = $remindService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $count = $this->remindService->fetchAndSendReminds();
        $this->info("[Remind] $count is processed");
    }
}
