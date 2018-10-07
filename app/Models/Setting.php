<?php

namespace App\Models;

use App\Observers\RecordFingerPrintTrait;
use DB;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Setting
 * @package App\Models
 * @version August 7, 2018, 2:20 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection campaignGroups
 * @property \Illuminate\Database\Eloquent\Collection groupContacts
 * @property \Illuminate\Database\Eloquent\Collection reminderUsers
 * @property \Illuminate\Database\Eloquent\Collection reminders
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property string module
 * @property string value
 * @property integer created_by
 * @property integer updated_by
 */
class Setting extends Model
{
    use RecordFingerPrintTrait;

    public $table = 'settings';

    const MODULE_CORE = 'core';
    const MODULE_EMAIL = 'email';

    const SETTING_SITE_NAME = 'site_title';
    const SETTING_SITE_EMAIL = 'site_system_email';
    const SETTING_ADDRESS = 'site_address';
    const SETTING_POST_CODE = 'site_post_code';
    const SETTING_COUNTRY = 'site_country';
    const SETTING_STATE = 'site_state';
    const SETTING_PHONE = 'site_phone';
    const SETTING_FAX = 'site_fax';
    const SETTING_ALLOW_USER_REGISTER = 'auth_allow_user_register';
    const SETTING_ALLOW_REMEMBER_ME = 'auth_allow_remember_me';
    const SETTING_REMEMBER_USERS_FOR = 'auth_remember_users_for';
    const SETTING_TAX_RATE = 'ext_tax_rate';
    const SETTING_STRIPE_TEST_MODE = 'ext_stripe_test_mode';
    const SETTING_STRIPE_PUBLISHABLE_TEST_KEY = 'ext_stripe_publishable_test_key';
    const SETTING_STRIPE_SECRET_TEST_KEY = 'ext_stripe_secret_test_key';
    const SETTING_STRIPE_PUBLISHABLE_KEY = 'ext_stripe_publishable_key';
    const SETTING_STRIPE_SECRET_KEY = 'ext_stripe_secret_key';
    const SETTING_USER_ID = 'ext_user_id';
    const SETTING_API_TOKEN = 'ext_api_token';
    const SETTING_API_SECRET = 'ext_api_secret';
    const SETTING_VIDEO = 'video';
    //emailer
    const SETTING_MAILPATH = 'mailpath';
    const SETTING_MAILTYPE = 'mailtype';
    const SETTING_PROTOCOL = 'protocol';
    const SETTING_SENDER_EMAIL = 'sender_email';
    const SETTING_SMTP_HOST = 'smtp_host';
    const SETTING_SMTP_PASS = 'smtp_pass';
    const SETTING_SMTP_PORT = 'smtp_port';
    const SETTING_SMTP_TIMEOUT = 'smtp_timeout';
    const SETTING_SMTP_USER = 'smtp_user';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'module',
        'value',
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
        'module' => 'string',
        'value' => 'string',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'module' => 'required',
        'value' => 'required'
    ];

    public static function defaultSettings()
    {
        return [
            self::SETTING_SITE_NAME => 'MomRemind',
            self::SETTING_SITE_EMAIL => 'support@momremind.com',
            self::SETTING_ADDRESS => 'California',
            self::SETTING_POST_CODE => '92683',
            self::SETTING_COUNTRY => 'US',
            self::SETTING_STATE => 'New York',
            self::SETTING_FAX => 'Fax',
            self::SETTING_PHONE => '(626) 244-7898',
            self::SETTING_VIDEO => 'https://vimeo.com/277785487',
            self::SETTING_ALLOW_REMEMBER_ME => 1,
            self::SETTING_REMEMBER_USERS_FOR => '1 week',
            self::SETTING_TAX_RATE => '8.5',
            self::SETTING_STRIPE_TEST_MODE => 0,
            self::SETTING_STRIPE_PUBLISHABLE_KEY => 'pk_live_YZTbfz4t0H3VRM06USa04eap',
            self::SETTING_STRIPE_SECRET_KEY => 'sk_live_OGTCdqWB9jWLkChvCoQ6KXbI',
            self::SETTING_STRIPE_PUBLISHABLE_TEST_KEY => 'pk_test_K08isIFrWpNknM51DI5G3LeM',
            self::SETTING_STRIPE_SECRET_TEST_KEY => 'sk_test_RZk8FBnHQrOG385EvuZq74EK',
            self::SETTING_ALLOW_USER_REGISTER => 0,
            self::SETTING_USER_ID => 'u-2ogx6bzpocwg55so3h6etgy',
            self::SETTING_API_SECRET => 'iiqj5fquho35pqrws4uxyzfg6ose2xtzd65lg6q',
            self::SETTING_API_TOKEN => 't-nih2xduui5zzsf6iggqgszy',
        ];
    }

    public static function defaultSettingsEmail()
    {
        return [
            self::SETTING_MAILPATH => '/usr/sbin/sendmail',
            self::SETTING_MAILTYPE => 'html',
            self::SETTING_PROTOCOL => 'smtp',
            self::SETTING_SENDER_EMAIL => 'no-repy@app.momremind.com',
            self::SETTING_SMTP_HOST => 'mail.app.momremind.com',
            self::SETTING_SMTP_PASS => '%T6%mc+2eDDE',
            self::SETTING_SMTP_PORT => '587',
            self::SETTING_SMTP_TIMEOUT => '30',
            self::SETTING_SMTP_USER => 'no-repy@app.momremind.com',
        ];
    }

    private static $allSettings = [];

    public static function allSettings($module = null)
    {
        if (empty(self::$allSettings)) {
            self::$allSettings = [
                self::MODULE_CORE => self::defaultSettings(),
                self::MODULE_EMAIL => self::defaultSettingsEmail()
            ];

            $data = self::all()->groupBy('module')->toArray();

            foreach ($data as $key => $items) {
                $data[$key] = array_pluck($items, 'value', 'name');
            }

            self::$allSettings = array_merge(self::$allSettings, $data);

        }
        if (isset($module) && isset(self::$allSettings[$module])) {
            return self::$allSettings[$module];
        }
        return array_flatten(self::$allSettings);
    }

    /**
     * @param $module
     * @param $params
     * @throws \Throwable
     */
    public static function updateAllSettings($module, $params)
    {
        DB::transaction(function () use ($params, $module) {
            foreach ($params as $name => $value) {
                $setting = self::where('name', $name)->first();
                if ($setting) {
                    $setting->value = $value;
                    $setting->save();
                } else {
                    self::create([
                        'name' => $name,
                        'module' => $module,
                        'value' => $value
                    ]);
                }
            }
            self::$allSettings = $params;
        });
    }

    public static function getSetting($module, $name, $default = '')
    {
        return isset(self::allSettings($module)[$name]) ? self::allSettings($module)[$name] : $default;
    }
}
