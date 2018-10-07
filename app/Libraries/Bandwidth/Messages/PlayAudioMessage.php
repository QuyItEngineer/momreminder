<?php
/**
 * Created by IntelliJ IDEA.
 * User: vuldh <vuldh@nal.vn>
 * Date: 8/18/18
 * Time: 11:13 AM
 */

namespace App\Libraries\Bandwidth\Messages;

/**
 * Class PlayAudioMessage
 * @package App\Libraries\Bandwidth\Messages
 * @author vuldh <vuldh@nal.vn>
 *
 * @property string callId
 * @property string fileUrl
 * @property string sentence
 * @property string gender
 * @property string locale
 * @property string voice
 * @property string loopEnabled
 * @property string tag
 */
class PlayAudioMessage extends BaseMessage
{
    protected $attributes = [
        'callId' => '',
        'fileUrl' => null,
        'sentence' => null,
        'gender' => 'female',
        'locale' => 'en_US',
        'voice' => 'julie',
        'loopEnabled' => null,
        'tag' => null,
    ];
}