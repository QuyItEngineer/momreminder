<?php

namespace App\Repositories;

use App\Criteria\CreatedByMeCriteria;
use App\Models\Call;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CallRepository
 * @package App\Repositories
 * @version August 9, 2018, 3:22 am UTC
 *
 * @method Call findWithoutFail($id, $columns = ['*'])
 * @method Call find($id, $columns = ['*'])
 * @method Call first($columns = ['*'])
*/
class CallRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'call_id',
        'from_phone',
        'to_phone',
        'audio',
        'bot',
        'sentense',
        'event_type',
        'time',
        'state',
        'status',
        'callback',
        'created_by',
        'updated_by'
    ];

    /**
     *Configure Criteria
     *
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     *
     * @author quyhbn <quyhbn@nal.vn>
     */
    public function boot()
    {
        parent::boot();
        $this->pushCriteria(new CreatedByMeCriteria());
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Call::class;
    }
}
