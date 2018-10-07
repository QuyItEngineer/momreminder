<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\User;

class UserDataTableTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\User $user
     * @return array
     * @throws \Throwable
     */
    public function transform(User $user)
    {
        return [
            'id' => (int) $user->id,
            'username' => $user->username,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->roles->count() > 0 ? $user->roles[0]->name: '' ,
            'created_at' => $user->created_at->toDateTimeString(),
            'updated_at' => $user->updated_at->toDateTimeString(),
            'action' => view('users.datatables_actions', [
                'id' => $user->id
            ])->render()
        ];
    }
}
