<?php

namespace App\Repositories;

use App\Models\Package;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PackageRepository
 * @package App\Repositories
 * @version September 3, 2018, 1:58 pm UTC
 *
 * @method Package findWithoutFail($id, $columns = ['*'])
 * @method Package find($id, $columns = ['*'])
 * @method Package first($columns = ['*'])
*/
class PackageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'price',
        'credit',
        'description',
        'sort_order',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Package::class;
    }
}
