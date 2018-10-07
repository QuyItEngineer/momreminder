<?php
/**
 * Created by IntelliJ IDEA.
 * User: vuldh <vuldh@nal.vn>
 * Date: 8/19/18
 * Time: 9:10 AM
 */

namespace App\Libraries\Bandwidth\Messages;


class CreateOutboundCallMessage extends BaseMessage
{
    protected $attributes = [
        'from' => '',
        'to' => '',
        'callTimeout' => null,
        'callbackUrl' => null,
        'callbackTimeout' => null,
        'callbackHttpMethod' => null,
        'fallbackUrl' => null,
        'bridgeId' => null,
        'conferenceId' => null,
        'recordingEnabled' => null,
        'recordingMaxDuration' => null,
        'recordingFileFormat' => null,
        'tag' => null,
        'sipHeaders' => null,
    ];
}