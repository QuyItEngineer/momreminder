<?php

namespace App\Repositories;

use App\Models\Setting;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SettingRepository
 * @package App\Repositories
 * @version August 7, 2018, 2:20 pm UTC
 *
 * @method Setting findWithoutFail($id, $columns = ['*'])
 * @method Setting find($id, $columns = ['*'])
 * @method Setting first($columns = ['*'])
*/
class SettingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'module',
        'value',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Setting::class;
    }
}
