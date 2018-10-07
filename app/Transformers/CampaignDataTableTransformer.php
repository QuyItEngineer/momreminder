<?php

namespace App\Transformers;

use App\Models\Campaign;
use League\Fractal\TransformerAbstract;

class CampaignDataTableTransformer extends TransformerAbstract
{
    /**
     * @param Campaign $campaignDataTable
     * @return array
     * @throws \Throwable
     */
    public function transform(Campaign $campaignDataTable)
    {
        return [
            'id' => (int) $campaignDataTable->id,
            'name' => $campaignDataTable->name,
            'created_by' => $campaignDataTable->createdBy->name,
            'message' => $campaignDataTable->message,
            'send_type' => trans('labels.template.send_type')[$campaignDataTable->send_type],
            'delivery' => trans('labels.campaign.deliveries')[$campaignDataTable->delivery],
            'created_at' => $campaignDataTable->created_at->toDateString(),
            'status' => view('layouts._status',[
                'status' => $campaignDataTable->status
            ])->render(),
            'action' => view('campaigns.datatables_actions',[
                'id' => $campaignDataTable->id
            ])->render()
        ];
    }
}