<?php

namespace App\Listeners;

use App\Contracts\CampaignService;
use App\Models\Campaign;
use App\Notifications\RemindNotification;
use App\Repositories\CampaignRepository;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationSentListener
{
    /**
     * @var CampaignService
     * @author vuldh <vuldh@nal.vn>
     */
    private $campaignService;

    /**
     * Create the event listener.
     *
     * @param CampaignService $campaignService
     */
    public function __construct(CampaignService $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    /**
     * Handle the event.
     *
     * @param  NotificationSent $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->notification instanceof RemindNotification) {
            /**
             * @var Campaign $campaign
             */
            $campaign = $event->notifiable;

            \Log::debug("[Remind] Sent reminder [{$campaign->name}]");
        }
    }
}
