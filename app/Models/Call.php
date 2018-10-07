<?php

namespace App\Models;

use App\Observers\RecordFingerPrintTrait;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Call
 * @package App\Models
 * @version August 9, 2018, 3:22 am UTC
 *
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection campaignGroups
 * @property \Illuminate\Database\Eloquent\Collection groupContacts
 * @property \Illuminate\Database\Eloquent\Collection reminderUsers
 * @property \Illuminate\Database\Eloquent\Collection reminders
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property integer user_id
 * @property string call_id
 * @property string from_phone
 * @property string to_phone
 * @property string audio
 * @property integer bot
 * @property string sentense
 * @property string event_type
 * @property string time
 * @property string state
 * @property boolean status
 * @property string callback
 * @property integer created_by
 * @property integer updated_by
 */
class Call extends Model
{
    use RecordFingerPrintTrait;

    const EVENT_TYPE_ANSWER = 'answer';

    const STATE_ACTIVE = 'active';

    public $table = 'calls';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'call_id',
        'from_phone',
        'to_phone',
        'audio',
        'bot',
        'sentense',
        'event_type',
        'time',
        'state',
        'status',
        'callback',
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
        'call_id' => 'string',
        'from_phone' => 'string',
        'to_phone' => 'string',
        'audio' => 'string',
        'bot' => 'integer',
        'sentense' => 'string',
        'event_type' => 'string',
        'time' => 'datetime',
        'state' => 'string',
        'status' => 'boolean',
        'callback' => 'string',
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
