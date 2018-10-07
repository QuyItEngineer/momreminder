<?php
/**
 * Created by IntelliJ IDEA.
 * User: vuldh <vuldh@nal.vn>
 * Date: 8/16/18
 * Time: 11:09 PM
 */

namespace App\Libraries\Bandwidth;


use App\Libraries\Bandwidth\Messages\CreateOutboundCallMessage;
use App\Libraries\Bandwidth\Messages\PlayAudioMessage;

class Voice extends Client
{
    /**
     * @param CreateOutboundCallMessage $message
     * @return mixed
     * @throws Exceptions\APIRequestException
     * @throws Exceptions\ValidationException
     * @author vuldh <vuldh@nal.vn>
     */
    public function createOutboundCall(CreateOutboundCallMessage $message)
    {
        $data = $message->getAttributes();

        $this->validate($data, [
            'from' => 'required|array',
            'to' => 'required'
        ]);

        foreach ($data['to'] as $toPhone) {
            $param = array_merge($data, [
                'to' => $toPhone
            ]);
            $this->makePostRequest('calls', $param);
        }
    }

    /**
     * @param PlayAudioMessage $message
     * @return mixed
     * @throws Exceptions\APIRequestException
     * @throws Exceptions\ValidationException
     * @author vuldh <vuldh@nal.vn>
     */
    public function playAudio(PlayAudioMessage $message)
    {

        $this->validate($message->getAttributes(), [
            'callId' => 'required'
        ]);

        return $this->makePostRequest("{$message->callId}/audio", $message->getAttributes());
    }
}