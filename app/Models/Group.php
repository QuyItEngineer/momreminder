<?php

namespace App\Models;

use App\Observers\RecordFingerPrintTrait;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Group
 * @package App\Models
 * @version July 26, 2018, 12:28 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection campaignGroups
 * @property \Illuminate\Database\Eloquent\Collection Campaign
 * @property \Illuminate\Database\Eloquent\Collection contacts
 * @property \Illuminate\Database\Eloquent\Collection ReminderUser
 * @property \Illuminate\Database\Eloquent\Collection Reminder
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property string name
 * @property string description
 * @property string status
 * @property integer created_by
 * @property integer updated_by
 */
class Group extends Model
{
    use RecordFingerPrintTrait;

    public $table = 'groups';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'id',
        'name',
        'description',
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
        'description' => 'string',
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
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function campaigns()
    {
        return $this->belongsToMany(\App\Models\Campaign::class, 'campaign_groups');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function contacts()
    {
        return $this->belongsToMany(\App\Models\Contact::class, 'group_contacts');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function reminderUsers()
    {
        return $this->hasMany(\App\Models\ReminderUser::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function reminders()
    {
        return $this->hasMany(\App\Models\Reminder::class);
    }
}
