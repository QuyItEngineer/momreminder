<?php
/**
 * Created by IntelliJ IDEA.
 * User: vuldh <vuldh@nal.vn>
 * Date: 8/22/18
 * Time: 11:26 PM
 */

namespace App\Repositories;


abstract class BaseRepository extends \InfyOm\Generator\Common\BaseRepository
{
    /**
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @author vuldh <vuldh@nal.vn>
     */
    public function count()
    {
        $this->applyCriteria();
        $this->applyScope();

        $result = $this->model->count();

        $this->resetModel();
        $this->resetScope();

        return $result;
    }

    /**
     * @param $where
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @author vuldh <vuldh@nal.vn>
     */
    public function countWhere($where)
    {
        $this->applyCriteria();
        $this->applyScope();
        $this->applyConditions($where);
        $result = $this->model->count();

        $this->resetModel();
        $this->resetScope();

        return $result;
    }
}