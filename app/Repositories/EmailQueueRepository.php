<?php

namespace App\Repositories;

use App\Models\EmailQueue;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EmailQueueRepository
 * @package App\Repositories
 * @version August 17, 2018, 3:04 am UTC
 *
 * @method EmailQueue findWithoutFail($id, $columns = ['*'])
 * @method EmailQueue find($id, $columns = ['*'])
 * @method EmailQueue first($columns = ['*'])
*/
class EmailQueueRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'to_email',
        'subject',
        'message',
        'alt_message',
        'max_attempts',
        'attempts',
        'success',
        'date_published',
        'last_attempt',
        'date_sent',
        'csv_attachment',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return EmailQueue::class;
    }
}
