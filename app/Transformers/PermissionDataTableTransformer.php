<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\PermissionDataTable;
use Spatie\Permission\Models\Permission;

class PermissionDataTableTransformer extends TransformerAbstract
{
    /**
     * @param Permission $permission
     * @return array
     * @throws \Throwable
     */
    public function transform(Permission $permission)
    {
        return [
            'id' => (int)$permission->id,
            'name' => $permission->name,
            'guard_name' => $permission->guard_name,
            'action' => view('permissions.datatables_actions', [
                'id' => $permission->id
            ])->render()
        ];
    }
}
