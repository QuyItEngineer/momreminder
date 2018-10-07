<?php
/**
 * Created by IntelliJ IDEA.
 * User: vuldh <vuldh@nal.vn>
 * Date: 8/18/18
 * Time: 11:12 AM
 */

namespace App\Channels\Bandwidth;

use App\Libraries\Bandwidth\Messages\BaseMessage;

interface ToBandwidth
{
    /**
     * @param  mixed $notifiable
     * @return BaseMessage
     * @author vuldh <vuldh@nal.vn>
     */
    public function toBandwidth($notifiable);
}