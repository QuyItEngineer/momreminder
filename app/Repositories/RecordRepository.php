<?php

namespace App\Repositories;

use App\Models\Record;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class RecordRepository
 * @package App\Repositories
 * @version July 26, 2018, 3:38 pm UTC
 *
 * @method Record findWithoutFail($id, $columns = ['*'])
 * @method Record find($id, $columns = ['*'])
 * @method Record first($columns = ['*'])
*/
class RecordRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'file',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Record::class;
    }
}
