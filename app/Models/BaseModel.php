<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lai Vu <vuldh@nal.vn>
 * Date: 7/26/18
 * Time: 22:22
 */

namespace App\Models;

use Eloquent as Model;

abstract class BaseModel extends Model
{
    const STATUS_ACTIVE = 0;
    const STATUS_IN_ACTIVE = 1;
}
