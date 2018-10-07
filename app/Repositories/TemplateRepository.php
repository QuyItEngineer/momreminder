<?php

namespace App\Repositories;

use App\Models\Template;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TemplateRepository
 * @package App\Repositories
 * @version July 24, 2018, 3:04 pm UTC
 *
 * @method Template findWithoutFail($id, $columns = ['*'])
 * @method Template find($id, $columns = ['*'])
 * @method Template first($columns = ['*'])
*/
class TemplateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'message',
        'send_type',
        'bot',
        'media',
        'voice',
        'record_id',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Template::class;
    }
}
