<?php

namespace App\Models;

use App\Observers\RecordFingerPrintTrait;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EmailQueue
 * @package App\Models
 * @version August 17, 2018, 3:04 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection campaignGroups
 * @property \Illuminate\Database\Eloquent\Collection groupContacts
 * @property \Illuminate\Database\Eloquent\Collection reminderUsers
 * @property \Illuminate\Database\Eloquent\Collection reminders
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property string to_email
 * @property string subject
 * @property string message
 * @property string alt_message
 * @property integer max_attempts
 * @property integer attempts
 * @property boolean success
 * @property string|\Carbon\Carbon date_published
 * @property string|\Carbon\Carbon last_attempt
 * @property string|\Carbon\Carbon date_sent
 * @property string csv_attachment
 * @property integer created_by
 * @property integer updated_by
 */
class EmailQueue extends Model
{
    use RecordFingerPrintTrait;

    public $table = 'email_queues';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'to_email',
        'subject',
        'message',
        'alt_message',
        'max_attempts',
        'attempts',
        'success',
        'date_published',
        'last_attempt',
        'date_sent',
        'csv_attachment',
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
        'to_email' => 'string',
        'subject' => 'string',
        'message' => 'string',
        'alt_message' => 'string',
        'max_attempts' => 'integer',
        'attempts' => 'integer',
        'success' => 'boolean',
        'csv_attachment' => 'string',
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

    
}
