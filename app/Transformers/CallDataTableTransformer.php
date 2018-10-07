<?php

namespace App\Transformers;

use App\Models\Call;
use DateTime;
use League\Fractal\TransformerAbstract;

class CallDataTableTransformer extends TransformerAbstract
{
    /**
     * @param Call $callDataTable
     * @return array
     * @throws \Throwable
     */
    public function transform(Call $callDataTable)
    {
        return [
            'call_id' => $callDataTable->call_id,
            'from_phone' => $callDataTable->from_phone,
            'to_phone' => $callDataTable->to_phone,
            'time' =>$callDataTable->time->toDateTimeString(),
            'state' => $callDataTable->state,
        ];
    }
}