<?php

namespace App\Events;

use App\Models\Campaign;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserCreditNotEnough
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var Campaign
     * @author vuldh <vuldh@nal.vn>
     */
    public $campaign;

    /**
     * Create a new event instance.
     *
     * @param Campaign $campaign
     */
    public function __construct(Campaign $campaign)
    {
        //
        $this->campaign = $campaign;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('remind.user-credit-not-enough');
    }
}
