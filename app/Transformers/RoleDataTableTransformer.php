<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Spatie\Permission\Models\Role;

class RoleDataTableTransformer extends TransformerAbstract
{
    /**
     * @param Role $role
     * @return array
     * @throws \Throwable
     */
    public function transform(Role $role)
    {
        return [
            'id' => (int) $role->id,
            'name' => $role->name,
            'guard_name' => $role->guard_name,
            'user_count' => $role->users->count(),
            'action' => view('roles.datatables_actions', [
                'id' => $role->id
            ])->render()
        ];
    }
}
