<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lai Vu <vuldh@nal.vn>
 * Date: 7/24/18
 * Time: 13:28
 */

namespace App\Contracts;


interface ActivityService
{
    public function log($message, $module = null);
}
