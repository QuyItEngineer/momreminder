<?php

namespace App\Transformers;

use App\Models\Record;
use League\Fractal\TransformerAbstract;

class RecordDataTableTransformer extends TransformerAbstract
{
    /**
     * @param Record $recordDataTable
     * @return array
     * @throws \Throwable
     */
    public function transform(Record $recordDataTable)
    {
        return [
            'id' => (int) $recordDataTable->id,
            'name' => $recordDataTable->name,
            'file' => $recordDataTable->file,
            'created_by' => $recordDataTable->createdBy->name,
            'created_at' => $recordDataTable->created_at->toDateTimeString(),
            'status' => view('layouts._status',[
                'status' => $recordDataTable->status
            ])->render()
        ];
    }
}