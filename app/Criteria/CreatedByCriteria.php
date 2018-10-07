<?php

namespace App\Criteria;

use Auth;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class CreatedByCriteria.
 *
 * @package namespace App\Criteria;
 */
class CreatedByCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('created_by', Auth::user()->id);
        return isset($model)? $model : null;
    }
}
