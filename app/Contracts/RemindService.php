<?php
/**
 * Created by IntelliJ IDEA.
 * User: vuldh <vuldh@nal.vn>
 * Date: 8/18/18
 * Time: 8:43 AM
 */

namespace App\Contracts;


interface RemindService
{
    /**
     * @return int
     * @author vuldh <vuldh@nal.vn>
     */
    public function fetchAndSendReminds();
}