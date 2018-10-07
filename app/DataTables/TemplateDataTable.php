<?php

namespace App\DataTables;

use App\Models\Template;
use App\Transformers\TemplateDataTableTransformer;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class TemplateDataTable extends DataTable
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

        return $dataTable->setTransformer(new TemplateDataTableTransformer());
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Template $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Template $model)
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
            ->addAction(['width' => '120px'])
            ->parameters([
                'dom'     => 'Bfrtip',
                'order'   => [[0, 'desc']],
                'buttons' => [
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
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
            'name',
            'created_by',
            'message',
            'send_type',
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
        return 'templatesdatatable_' . time();
    }
}
