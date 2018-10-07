<?php

namespace App\Notifications;

use App\Channels\Bandwidth\BandwidthChannel;
use App\Channels\Bandwidth\ToBandwidth;
use App\Libraries\Bandwidth\Messages\BaseMessage;
use App\Libraries\Bandwidth\Messages\CreateOutboundCallMessage;
use App\Libraries\Bandwidth\Messages\SMSMessage;
use App\Libraries\Bandwidth\Voice;
use App\Models\Campaign;
use App\Models\Setting;
use App\Models\Template;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RemindNotification extends Notification implements ToBandwidth, ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        \Log::debug('Prepare send remind notification');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  Campaign $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // Set delay
        if (isset($notifiable->delay_time)) {
            $this->delay($notifiable->delay_time);
            \Log::debug("Remind will be delay to {$notifiable->delay_time->toDateTimeString()}");
        }

        return [BandwidthChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  Campaign $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  Campaign $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    /**
     * @param  Campaign $notifiable
     * @return BaseMessage
     * @author vuldh <vuldh@nal.vn>
     */
    public function toBandwidth($notifiable)
    {
        \Log::debug('[Remind] Building message for ' . $notifiable->name);
        $message = null;
        $to = [];
        $from = Setting::getSetting(Setting::MODULE_CORE, Setting::SETTING_PHONE);

        // Create phone to
        if ($notifiable->send_to == Campaign::SEND_TO_PHONE) {
            $to = explode(',', $notifiable->phones);
        }

        if ($notifiable->send_to == Campaign::SEND_TO_GROUP) {
            $to = $notifiable->group->contacts->pluck('phone');
        }

        // Create by send type
        if ($notifiable->send_type == Template::SEND_TYPE_SMS) {

            $text = $notifiable->message;

            $message = new SMSMessage([
                'to' => $to,
                'from' => $from,
                'text' => $text,
                'media' => route_file($notifiable->media),
                'tag' => json_encode([
                    'userId' => $notifiable->created_by,
                    'campaignId' => $notifiable->id
                ])
            ]);
        }

        if ($notifiable->send_type == Template::SEND_TYPE_VOICE) {

            $message = new CreateOutboundCallMessage([
                'to' => $to,
                'from' => $from,
                'tag' => json_encode([
                    'userId' => $notifiable->created_by,
                    'campaignId' => $notifiable->id
                ])
            ]);
        }

        return $message
            ->error()
            ->setErrorHandler(function (\Exception $ex, $notifiable, $notification) {

            });
    }
}
