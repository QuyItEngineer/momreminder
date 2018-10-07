<?php

namespace App\Models;

use App\Observers\RecordFingerPrintTrait;
use Carbon\Carbon;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Template
 * @package App\Models
 * @version July 24, 2018, 3:04 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection campaignGroups
 * @property \Illuminate\Database\Eloquent\Collection Campaign
 * @property \Illuminate\Database\Eloquent\Collection groupContacts
 * @property \Illuminate\Database\Eloquent\Collection reminderUsers
 * @property \Illuminate\Database\Eloquent\Collection reminders
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property string name
 * @property string message
 * @property string send_type
 * @property boolean bot
 * @property string media
 * @property string voice
 * @property integer record_id
 * @property string status
 * @property integer created_by
 * @property integer updated_by
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Template extends Model
{
    use RecordFingerPrintTrait;

    public $table = 'templates';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const SEND_TYPE_SMS = 0;
    const SEND_TYPE_VOICE = 1;

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'message',
        'send_type',
        'bot',
        'media',
        'voice',
        'record_id',
        'status',
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
        'name' => 'string',
        'message' => 'string',
        'send_type' => 'string',
        'bot' => 'boolean',
        'media' => 'string',
        'voice' => 'string',
        'record_id' => 'integer',
        'status' => 'string',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'message' => 'max:160',
        'send_type' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function campaigns()
    {
        return $this->hasMany(\App\Models\Campaign::class);
    }

    public static function bootSearchableTrait() {
        dd('');
    }
}
