<?php

namespace App\Repositories;

use App\Models\Message;

/**
 * Class MessageRepository
 * @package App\Repositories
 * @version August 9, 2018, 9:12 am UTC
 *
 * @method Message findWithoutFail($id, $columns = ['*'])
 * @method Message find($id, $columns = ['*'])
 * @method Message first($columns = ['*'])
*/
class MessageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'message_id',
        'from',
        'to',
        'text',
        'media',
        'time',
        'fallback_url',
        'skip_mms_carrier_validation',
        'direction',
        'state',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Message::class;
    }
}
