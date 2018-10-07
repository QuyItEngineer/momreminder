<?php
/**
 * Created by IntelliJ IDEA.
 * User: vuldh <vuldh@nal.vn>
 * Date: 8/18/18
 * Time: 11:14 AM
 */

namespace App\Libraries\Bandwidth\Messages;

/**
 * Class SMSMessage
 * @package App\Libraries\Bandwidth\Messages
 * @author vuldh <vuldh@nal.vn>
 *
 * @property-read string to
 * @property-read string from
 * @property-read string text
 * @property-read string media
 * @property-read string receiptRequested
 * @property-read string callbackUrl
 * @property-read string callbackHttpMethod
 * @property-read string callbackTimeout
 * @property-read string fallbackUrl
 * @property-read string tag
 */
class SMSMessage extends BaseMessage
{
    protected $attributes = [
        'to' => '',
        'from' => '',
        'text' => '',
        'media' => null,
        'receiptRequested' => null,
        'callbackUrl' => null,
        'callbackHttpMethod' => null,
        'callbackTimeout' => null,
        'fallbackUrl' => null,
        'tag' => null
    ];

    public function setTo($to)
    {
        $this->attributes['to'] = $to;
    }

    public function setFrom($from)
    {
        $this->attributes['from'] = $from;
    }


}