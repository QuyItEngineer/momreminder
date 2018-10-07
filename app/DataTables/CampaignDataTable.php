<?php

namespace App\DataTables;

use App\Models\Campaign;
use App\Transformers\CampaignDataTableTransformer;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CampaignDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new CampaignDataTableTransformer());
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Campaign $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Campaign $model)
    {
        return $model->newQuery();
    }

    /**x
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'name',
            'created_by',
            'message',
            'send_type',
            'delivery',
            'created_at',
            'status',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'campaignsdatatable_' . time();
    }
}
