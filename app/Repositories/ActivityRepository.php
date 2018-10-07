<?php

namespace App\Repositories;

use App\Models\Activity;

/**
 * Class ActivityRepository
 * @package App\Repositories
 * @version July 24, 2018, 6:23 am UTC
 *
 * @method Activity findWithoutFail($id, $columns = ['*'])
 * @method Activity find($id, $columns = ['*'])
 * @method Activity first($columns = ['*'])
*/
class ActivityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'activity',
        'module',
        'created_by',
        'update_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Activity::class;
    }
}
