<?php

namespace App\Transformers;

use App\Models\Template;
use League\Fractal\TransformerAbstract;

class TemplateDataTableTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\Template $template
     * @return array
     * @throws \Throwable
     */
    public function transform(Template $template)
    {
        return [
            'name' => $template->name,
            'created_by' => $template->createdBy ? $template->createdBy->name : '',
            'message' => $template->message,
            'created_at' => $template->created_at->toDateTimeString(),
            'updated_at' => $template->updated_at->toDateTimeString(),
            'status' => $template->status,
            'send_type' => trans('labels.template.send_type')[$template->send_type],
            'action' => view('templates.datatables_actions', [
                'id' => $template->id
            ])->render()
        ];
    }
}
