<?php

namespace App\DataTables;

use App\Criteria\CreatedByMeCriteria;
use App\Models\Call;
use App\Transformers\CallDataTableTransformer;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CallDataTable extends DataTable
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

        return $dataTable->setTransformer(new CallDataTableTransformer());
    }

    /**
     * Get query source of dataTable.
     *
     * @param Call $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Call $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom' => 'Bfrtip',
                'order' => [[0, 'desc']],
                'buttons' => [
                ],
                'searching' => false
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'call_id' => [
                'name' => 'call_id',
                'data' => 'call_id',
                'title' => 'Voice id',
                'orderable' => true,
            ],
            'from_phone',
            'to_phone',
            'time',
            'state'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'callsdatatable_' . time();
    }
}
