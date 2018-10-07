<?php

namespace App\Criteria;

use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class MyselfCriteria.
 *
 * @package namespace App\Criteria;
 */
class CreatedByMeCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param \Illuminate\Database\Eloquent\Builder $model
     * @param RepositoryInterface $repository
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if (!\Auth::guest()) {
            $model = $model->where('created_by', \Auth::user()->id);
        }
        return $model;
    }
}
