<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lai Vu <vuldh@nal.vn>
 * Date: 7/24/18
 * Time: 13:27
 */

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class Activity extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'activity';
    }
}
