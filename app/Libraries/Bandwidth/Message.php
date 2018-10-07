<?php
/**
 * Created by IntelliJ IDEA.
 * User: vuldh <vuldh@nal.vn>
 * Date: 8/16/18
 * Time: 10:53 PM
 */

namespace App\Libraries\Bandwidth;


use App\Libraries\Bandwidth\Messages\SMSMessage;

class Message extends Client
{
    /**
     * @param SMSMessage $message
     * @return mixed
     * @throws Exceptions\APIRequestException
     * @throws Exceptions\ValidationException
     * @author vuldh <vuldh@nal.vn>
     */
    public function sendMessage(SMSMessage $message)
    {
        $data = $message->getAttributes();

        $this->validate($data, [
            'to' => 'required|array',
            'from' => 'required',
            'text' => 'required'
        ]);

        foreach ($data['to'] as $toPhone) {
            $param = array_merge($data, [
                'to' => $toPhone
            ]);
            $this->makePostRequest('messages', $param);
        }
    }
}