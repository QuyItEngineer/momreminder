<?php

namespace App\Transformers;

use App\Models\Message;
use League\Fractal\TransformerAbstract;
use App\MessageDataTable;

class MessageDataTableTransformer extends TransformerAbstract
{
    /**
     * @param Message $messageDataTable
     * @return array
     */
    public function transform(Message $messageDataTable)
    {
        return [
            'message_id' => $messageDataTable->message_id,
            'media' => isset($messageDataTable->media) ? $messageDataTable->media : 'SMS',
            'from' => $messageDataTable->from,
            'to' =>$messageDataTable->to,
            'text' => $messageDataTable->text,
            'time' => $messageDataTable->time->toDateTimeString(),
            'direction' => $messageDataTable->direction,
            'state' => $messageDataTable->state,
        ];
    }
}