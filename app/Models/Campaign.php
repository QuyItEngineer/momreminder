<?php

namespace App\Models;

use App\Observers\RecordFingerPrintTrait;
use Carbon\Carbon;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Notifications\Notifiable;

/**
 * Class Campaign
 * @package App\Models
 * @version July 27, 2018, 9:10 am UTC
 *
 * @property \App\Models\Group group
 * @property \App\Models\Record record
 * @property \App\Models\Template template
 * @property \Illuminate\Database\Eloquent\Collection campaignGroups
 * @property \Illuminate\Database\Eloquent\Collection groupContacts
 * @property \Illuminate\Database\Eloquent\Collection Outbox
 * @property \Illuminate\Database\Eloquent\Collection reminderUsers
 * @property \Illuminate\Database\Eloquent\Collection reminders
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property integer record_id
 * @property integer group_id
 * @property integer template_id
 * @property string name
 * @property string delivery
 * @property string routine_appointment
 * @property Carbon date
 * @property string time
 * @property Carbon timestamp
 * @property Carbon delay_time
 * @property string message
 * @property string send_to
 * @property string send_type
 * @property boolean bot
 * @property string phones
 * @property string media
 * @property string voice
 * @property boolean status
 * @property int credit_cost
 * @property integer created_by
 * @property integer updated_by
 * @property Carbon created_at
 *
 * @method remindDue()
 */
class Campaign extends Model
{
    use RecordFingerPrintTrait, Notifiable;

    const DELIVERY_IMMEDIATELY = 0;
    const DELIVERY_10_MINUTES = 1;
    const DELIVERY_30_MINUTES = 2;
    const DELIVERY_1_HOUR = 3;
    const DELIVERY_2_HOURS = 4;
    const DELIVERY_4_HOURS = 5;
    const DELIVERY_OTHER = 6;

    const ROUTINE_MONTHLY = 0;
    const ROUTINE_2_MONTHS = 1;
    const ROUTINE_3_MONTHS = 2;
    const ROUTINE_6_MONTHS = 3;

    const SEND_TO_PHONE = 0;
    const SEND_TO_GROUP = 1;

    public $table = 'campaigns';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'record_id',
        'group_id',
        'template_id',
        'name',
        'delivery',
        'routine_appointment',
        'date',
        'time',
        'timestamp',
        'message',
        'send_to',
        'send_type',
        'bot',
        'phones',
        'media',
        'voice',
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
        'record_id' => 'integer',
        'group_id' => 'integer',
        'template_id' => 'integer',
        'name' => 'string',
        'delivery' => 'string',
        'routine_appointment' => 'string',
        'date' => 'date',
        'time' => 'string',
        'message' => 'string',
        'send_to' => 'string',
        'send_type' => 'string',
        'bot' => 'boolean',
        'phones' => 'string',
        'media' => 'string',
        'voice' => 'string',
        'timestamp' => 'datetime',
        'status' => 'boolean',
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
        'delivery' => 'required',
        'phones' => 'required_if:send_to,' . self::SEND_TO_PHONE,
        'group_id' => 'required_if:send_to,' . self::SEND_TO_GROUP,
        'date' => 'nullable|required_if:delivery,' . self::DELIVERY_OTHER . '|date_format:Y-m-d',
        'time' => 'nullable|required_if:delivery,' . self::DELIVERY_OTHER . '|date_format:"H:i"'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function group()
    {
        return $this->belongsTo(\App\Models\Group::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function record()
    {
        return $this->belongsTo(\App\Models\Record::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function template()
    {
        return $this->belongsTo(\App\Models\Template::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function groups()
    {
        return $this->belongsToMany(\App\Models\Group::class, 'campaign_groups');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function outboxes()
    {
        return $this->hasMany(\App\Models\Outbox::class);
    }

    /**
     * @param Builder $query
     * @return mixed
     * @author vuldh <vuldh@nal.vn>
     */
    public function scopeRemindDue($query)
    {
        $now = Carbon::now();
        $inFiveMinutes = Carbon::now()->subMinutes(5);
        return $query
            ->where('timestamp', '<=', $now->toDateTimeString())
            ->where('timestamp', '>=', $inFiveMinutes->toDateTimeString());
    }

    public function getDelayTimeAttribute()
    {
        $dateTime = $this->timestamp->copy();
        if (isset($this->delivery)) {
            switch ($this->delivery) {
                case self::DELIVERY_10_MINUTES:
                    $dateTime->addMinutes(10);
                    break;
                case self::DELIVERY_30_MINUTES:
                    $dateTime->addMinutes(30);
                    break;
                case self::DELIVERY_1_HOUR:
                    $dateTime->addHour();
                    break;
                case self::DELIVERY_2_HOURS:
                    $dateTime->addHours(2);
                    break;
                case self::DELIVERY_4_HOURS:
                    $dateTime->addHours(4);
                    break;
                case self::DELIVERY_OTHER:

                    $dateTime->setDate($dateTime->year, $this->date->month, $this->date->day);
                    list($hour, $minute) = explode(':', $this->time);
                    $dateTime->setTime($hour, $minute);
                    break;
            }
        }
        return $dateTime;
    }

    public function getCreditCostAttribute()
    {
        $cost = 1;
        try {
            if ($this->send_type == Template::SEND_TYPE_VOICE
                && isset($this->record)
                && \Storage::exists($this->record->file)) {

                $audio = new \wapmorgan\Mp3Info\Mp3Info(\Storage::path($this->record->file), true);

                $cost = intval($audio->duration / 30);
            }
        } catch (\Exception $e) {
        }

        if ($cost < 1) {
            return 1;
        }

        return $cost;
    }
}
