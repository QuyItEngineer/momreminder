<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Role
 * @package App\Models
 * @version July 23, 2018, 8:59 am UTC
 *
 * @property string name
 * @property string guard_name
 */
class Role extends Model
{

    public $table = 'roles';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_SPECIAL = 'special';


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
