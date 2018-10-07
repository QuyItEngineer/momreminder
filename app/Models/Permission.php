<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Permission
 * @package App\Models
 * @version July 23, 2018, 10:09 am UTC
 *
 * @property string name
 * @property string guard_name
 */
class Permission extends Model
{

    public $table = 'permissions';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'guard_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'guard_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];
}
