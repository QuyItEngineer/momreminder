<?php

namespace App\DataTables;

use App\Models\Message;
use App\Transformers\MessageDataTableTransformer;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class MessageDataTable extends DataTable
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

        return $dataTable->setTransformer(new MessageDataTableTransformer());
    }

    /**
     * Get query source of dataTable.
     *
     * @param Message $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Message $model)
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
                'dom'     => 'Blfrtip',
                'order'   => [[0, 'desc']],
                'buttons' => [
                ],
                'paging' => TRUE
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
            'message_id' => [
                'name' => 'message_id',
                'data' => 'message_id',
                'title' => 'ID',
                'orderable' => true,
            ],
            'media' => [
                'name' => 'media',
                'data' => 'media',
                'title' => 'SMS/MMS',
                'orderable' => true,
            ],
            'from',
            'to',
            'text',
            'time',
            'state',
            'direction',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'messagesdatatable_' . time();
    }
}
