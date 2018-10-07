<?php
/**
 * Created by IntelliJ IDEA.
 * User: vuldh <vuldh@nal.vn>
 * Date: 8/18/18
 * Time: 11:08 AM
 */

namespace App\Channels\Bandwidth;


use App\Libraries\Bandwidth\Message;
use App\Libraries\Bandwidth\Messages\CreateOutboundCallMessage;
use App\Libraries\Bandwidth\Messages\SMSMessage;
use App\Libraries\Bandwidth\Messages\PlayAudioMessage;
use App\Libraries\Bandwidth\Voice;
use App\Models\Campaign;
use \Illuminate\Notifications\Notification;

class BandwidthChannel
{
    /**
     * Send the given notification.
     *
     * @param  Campaign $notifiable
     * @param  \Illuminate\Notifications\Notification|ToBandwidth $notification
     * @return void
     * @throws \Exception
     */
    public function send($notifiable, Notification $notification)
    {
        \Log::debug("[Remind] Sending remind [{$notifiable->name}]");
        $message = $notification->toBandwidth($notifiable);
        \Log::debug('[Remind] Will be sending to ' . get_class($message));
        // Send notification to the $notifiable instance...
        try {
            if ($message instanceof SMSMessage) {
                /**
                 * @var Message $client
                 */
                $client = app(Message::class);
                \Log::debug('Will be sent to: '.json_encode($message->to));
                $client->sendMessage($message);
            }

            if ($message instanceof CreateOutboundCallMessage) {
                /**
                 * @var Voice $client
                 */
                $client = app(Voice::class);
                $client->createOutboundCall($message);
            }
        } catch (\Exception $ex) {
            if ($message->isErrorReport()) {
                ($message->getErrorHandler())($ex, $notifiable, $notification);
            }
            throw $ex;
        }
    }
}