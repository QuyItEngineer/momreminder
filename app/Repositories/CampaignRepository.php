<?php

namespace App\Repositories;

use App\Models\Campaign;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CampaignRepository
 * @package App\Repositories
 * @version July 27, 2018, 9:10 am UTC
 *
 * @method Campaign findWithoutFail($id, $columns = ['*'])
 * @method Campaign find($id, $columns = ['*'])
 * @method Campaign first($columns = ['*'])
*/
class CampaignRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'record_id',
        'group_id',
        'template_id',
        'name',
        'delivery',
        'routine_appointment',
        'date',
        'time',
        'timestamp',
        'message',
        'send_to',
        'send_type',
        'bot',
        'phones',
        'media',
        'voice',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Campaign::class;
    }
}
