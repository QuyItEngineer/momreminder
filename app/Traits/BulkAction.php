<?php
/**
 * Created by IntelliJ IDEA.
 * User: vuldh
 * Date: 7/31/18
 * Time: 4:17 PM
 */

namespace App\Traits;


use App\Http\Requests\BulkActionRequest;
use App\Models\BaseModel;
use InfyOm\Generator\Utils\ResponseUtil;
use Response;

/**
 * Trait BulkAction
 * @package App\Traits
 *
 * @
 */
trait BulkAction
{
    /**
     * @var \Eloquent
     */
    private $bulkModel = null;

    /**
     * @param BulkActionRequest $request
     * @return mixed
     * @throws \Throwable
     */
    public function bulk(BulkActionRequest $request)
    {
        $action = $request->get('action');
        $ids = $request->get('ids');
        \DB::transaction(function () use ($action, $ids) {
            switch ($action) {
                case BulkActionRequest::ACTION_ACTIVE:
                    $this->bulkModel::whereIn('id', $ids)->update(['status' => BaseModel::STATUS_ACTIVE]);
                    break;
                case BulkActionRequest::ACTION_INACTIVE:
                    $this->bulkModel::whereIn('id', $ids)->update(['status' => BaseModel::STATUS_IN_ACTIVE]);
                    break;
                case BulkActionRequest::ACTION_DELETE:
                    $this->bulkModel::whereIn('id', $ids)->delete();
                    break;
            }
        });
        return Response::json(ResponseUtil::makeResponse('Bulk ' . $action . ' is completed', true));
    }
}