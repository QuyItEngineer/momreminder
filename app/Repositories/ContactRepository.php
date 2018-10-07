<?php

namespace App\Repositories;

use App\Criteria\CreatedByCriteria;
use App\Models\Contact;

/**
 * Class ContactRepository
 * @package App\Repositories
 * @version July 24, 2018, 2:57 pm UTC
 *
 * @method Contact findWithoutFail($id, $columns = ['*'])
 * @method Contact find($id, $columns = ['*'])
 * @method Contact first($columns = ['*'])
*/
class ContactRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
     * Configure the Criteria
     *
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(CreatedByCriteria::class);
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Contact::class;
    }
}
