<?php

namespace App\Models;

use App\Observers\RecordFingerPrintTrait;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Message
 * @package App\Models
 * @version August 9, 2018, 9:12 am UTC
 *
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection campaignGroups
 * @property \Illuminate\Database\Eloquent\Collection groupContacts
 * @property \Illuminate\Database\Eloquent\Collection reminderUsers
 * @property \Illuminate\Database\Eloquent\Collection reminders
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property integer user_id
 * @property string message_id
 * @property string from
 * @property string to
 * @property string text
 * @property string media
 * @property string time
 * @property string fallback_url
 * @property string skip_mms_carrier_validation
 * @property string direction
 * @property string state
 * @property integer created_by
 * @property integer updated_by
 */
class Message extends Model
{
    use RecordFingerPrintTrait;

    public $table = 'messages';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'message_id',
        'from',
        'to',
        'text',
        'media',
        'time',
        'fallback_url',
        'skip_mms_carrier_validation',
        'direction',
        'state',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'message_id' => 'string',
        'from' => 'string',
        'to' => 'string',
        'text' => 'string',
        'media' => 'string',
        'time' => 'datetime',
        'fallback_url' => 'string',
        'skip_mms_carrier_validation' => 'string',
        'direction' => 'string',
        'state' => 'string',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
