<?php

namespace App\Models;

use App\Observers\RecordFingerPrintTrait;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Contact
 * @package App\Models
 * @version July 24, 2018, 2:57 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection campaignGroups
 * @property \Illuminate\Database\Eloquent\Collection groupContacts
 * @property \Illuminate\Database\Eloquent\Collection Outbox
 * @property \Illuminate\Database\Eloquent\Collection reminderUsers
 * @property \Illuminate\Database\Eloquent\Collection reminders
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property string name
 * @property string phone
 * @property string email
 * @property date birthday
 * @property boolean member
 * @property string status
 * @property integer created_by
 * @property integer updated_by
 */
class Contact extends Model
{
    use RecordFingerPrintTrait;
    public $table = 'contacts';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'phone',
        'email',
        'birthday',
        'member',
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
        'phone' => 'string',
        'email' => 'string',
        'birthday' => 'date',
        'member' => 'boolean',
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
        'email' => 'email|unique:contacts',
        'member' => 'required',
        'status' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function groups()
    {
        return $this->belongsToMany(\App\Models\Group::class, 'group_contacts');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function outboxes()
    {
        return $this->hasMany(\App\Models\Outbox::class);
    }
}
