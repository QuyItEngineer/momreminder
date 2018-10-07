<?php

namespace App\Transformers;

use App\Models\Group;
use League\Fractal\TransformerAbstract;

class GroupDataTableTransformer extends TransformerAbstract
{
    /**
     * @param Group $groupDataTable
     * @return array
     * @throws \Throwable
     */
    public function transform(Group $groupDataTable)
    {
        return [
            'name' => $groupDataTable->name,
            'description' => $groupDataTable->description,
            'created_at' => $groupDataTable->created_at->toDateTimeString(),
            'updated_at' => $groupDataTable->updated_at->toDateTimeString(),
            'status' => view('layouts._status',[
                'status' => $groupDataTable->status
            ])->render(),
            'action' => view('groups.datatables_actions',[
                'id' => $groupDataTable->id
            ])->render()
        ];
    }
}