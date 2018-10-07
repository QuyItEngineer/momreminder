<?php
/**
 * Created by PhpStorm.
 * User: macintosh
 * Date: 8/3/18
 * Time: 7:35 PM
 */

namespace App\Transformers;


use App\Models\Contact;
use App\Models\Group;
use League\Fractal\TransformerAbstract;

class ContactDataTableTransformer extends TransformerAbstract
{
    /**
     * @param Contact $contactDataTable
     * @return array
     * @throws \Throwable
     */
    public function transform(Contact $contactDataTable)
    {
        return [
            'name' => $contactDataTable->name,
            'email' => $contactDataTable->email,
            'phone' => $contactDataTable->phone,
            'group' => join(',',$contactDataTable->groups->map(function(Group $group) {return $group->name;})->toArray()),
            'created_at' => $contactDataTable->created_at->toDateTimeString(),
            'status' => view('layouts._status',[
                'status' => $contactDataTable->status
            ])->render(),
            'action' => view('contacts.datatables_actions',[
                'id' => $contactDataTable->id
            ])->render()
        ];
    }
}