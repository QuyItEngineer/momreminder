<?php

namespace App\Repositories;

use InfyOm\Generator\Common\BaseRepository;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionRepository
 * @package App\Repositories
 * @version July 23, 2018, 10:09 am UTC
 *
 * @method Permission findWithoutFail($id, $columns = ['*'])
 * @method Permission find($id, $columns = ['*'])
 * @method Permission first($columns = ['*'])
*/
class PermissionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'guard_name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Permission::class;
    }
}
