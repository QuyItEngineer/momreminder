<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $phone
 * @property string $name
 * @property string $address
 * @property string $password
 * @property string $remember_token
 * @property string $stripe_id
 * @property string $card_brand
 * @property string $card_last_four
 * @property string $trial_ends_at
 * @property int $credit
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User permission($permissions)
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User role($roles)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withoutTrashed()
 * @mixin \Eloquent
 * @property string $avatar
 * @property-read \App\Models\UserDetail $userDetail
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAvatar($value)
 */
class User extends Authenticatable
{
    use SoftDeletes, HasRoles, Notifiable, HasApiTokens, Billable;

    public $table = 'users';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'username',
        'email',
        'phone',
        'name',
        'address',
        'password',
        'avatar',
        'credit',
        'remember_token'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'username' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'name' => 'string',
        'address' => 'string',
        'password' => 'string',
        'remember_token' => 'string',
        'avatar' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'username' => 'required|unique:users',
        'email' => 'required|unique:users',
        'phone' => 'required|unique:users',
        'name' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userDetail()
    {
        return $this->hasOne(\App\Models\UserDetail::class);
    }

    public function socialAccounts()
    {
        return $this->hasMany(SocialAccount::class);
    }
}
