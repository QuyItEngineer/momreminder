<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Libraries\Bandwidth\Messages\PlayAudioMessage;
use App\Libraries\Bandwidth\Voice;
use App\Models\Call;
use App\Models\Campaign;
use App\Models\Template;
use App\Repositories\CallRepository;
use App\Repositories\CampaignRepository;
use App\Repositories\MessageRepository;
use Illuminate\Http\Request;

class CallbackAPIController extends AppBaseController
{

    /**
     * @var MessageRepository
     * @author vuldh <vuldh@nal.vn>
     */
    private $messageRepository;
    /**
     * @var CallRepository
     * @author vuldh <vuldh@nal.vn>
     */
    private $callRepository;
    /**
     * @var CampaignRepository
     * @author vuldh <vuldh@nal.vn>
     */
    private $campaignRepository;

    public function __construct(
        MessageRepository $messageRepository,
        CallRepository $callRepository,
        CampaignRepository $campaignRepository
    )
    {
        $this->messageRepository = $messageRepository;
        $this->callRepository = $callRepository;
        $this->campaignRepository = $campaignRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     * @author vuldh <vuldh@nal.vn>
     */
    public function message(Request $request)
    {
        $data = $request->all();
        $tags = json_decode($data['tag']);

        $messageId = $data['messageId'];
        $attributes = [
            'user_id' => $tags['userId'],
            'message_id' => $messageId,
            'from' => $data['from'],
            'to' => $data['to'],
            'text' => $data['text'],
            'media' => $data['media'],
            'time' => $data['time'],
            'direction' => $data['direction'],
            'state' => $data['state'],
            'event_type' => $data['eventType']
        ];
        $message = $this->messageRepository->findWhere([
            'messageId' => $messageId
        ]);

        if (isset($message)) {
            $this->messageRepository->update($attributes, $message->id);
        } else {
            $this->messageRepository->create($attributes);
        }
        return $this->sendResponse(true, 'Callback is received');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     * @throws \App\Libraries\Bandwidth\Exceptions\ValidationException
     * @author vuldh <vuldh@nal.vn>
     */
    public function voice(Request $request)
    {
        $data = $request->all();
        $tags = json_decode($data['tag']);

        $callId = $data['callId'];
        $campaignId = $tags['campaignId'];

        $attributes = [
            'user_id' => $tags['userId'],
            'call_id' => $callId,
            'from_phone' => $data['from'],
            'to_phone' => $data['to'],
            'media' => $data['media'],
            'time' => $data['time'],
            'state' => $data['callState'],
            'event_type' => $data['eventType']
        ];

        /**
         * @var Call $call
         */
        $call = $this->callRepository->findWhere([
            'call_id' => $callId
        ]);

        if (isset($call)) {
            $this->callRepository->update($attributes, $call->id);
        } else {
            $call = $this->callRepository->create($attributes);
        }

        if ($call->event_type == Call::EVENT_TYPE_ANSWER
            && $call->state == Call::STATE_ACTIVE) {
            $campaign = $this->campaignRepository->find($campaignId);

            if ($campaign->send_type == Template::SEND_TYPE_VOICE) {
                $attributes = [
                    'callId' => $callId
                ];

                if ($campaign->bot && !empty($campaign->message)) {
                    $attributes['sentence'] = $campaign->message;
                }

                if (!$campaign->bot && !empty($campaign->record_id)) {
                    $attributes['fileUrl'] = route_file($campaign->record->file);
                }

                $voiceMessage = new PlayAudioMessage($attributes);

                /**
                 * @var Voice $voice
                 */
                $voice = app('bandwidth_voice');

                $voice->playAudio($voiceMessage);

            }

        }

        return $this->sendResponse(true, 'Callback is received');
    }
}
