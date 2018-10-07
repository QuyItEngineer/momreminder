<?php

namespace App\DataTables;

use App\Models\Contact;
use App\Models\Group;
use App\Models\User;
use App\Transformers\ContactDataTableTransformer;
use Carbon\Carbon;
use DateTime;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ContactDataTable extends DataTable
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
        $dataTable->filter(function ($query){
            $request = request();
            $selectDataGroup = $request->get('groups');
            $date = $request->get('from_date');
            $date_to = $request->get('to_date');

            if ( ($request->has('keyword'))) {

                $query->where(function ($query) use ($request) {
                    $query->orwhere('name', 'like', "%{$request->get('keyword')}%");
                    $query->orwhere('email', 'like', "%{$request->get('keyword')}%");
                    $query->orwhere('phone', 'like', "%{$request->get('keyword')}%");
                });
            }

            if ( !is_null($date) && !is_null($date_to)) {
                if ($request->has('form_date') > $request->has('to_date')) {
                    $query->where('created_at', '<=', "{$date_to}");
                }
                else {
                    $query->where('created_at', '>=', "{$date}");
                    $query->where('created_at', '<=', "{$date_to}");
                }
            }
            elseif (!is_null($date)) {
                $query->where('created_at', '>=', "{$date}");
            }
            elseif (!is_null($date_to)) {
                $query->where('created_at', '<=', "{$date_to}");
            }

            if ( ! is_null($selectDataGroup)) {
                $query->whereHas('groups', function ($query) use ($request) {
                    $query->where('id', 'like', "%{$request->get('groups')}%");
                });
            }
        });

        return $dataTable->setTransformer(new ContactDataTableTransformer());
    }

    /**
     * Get query source of dataTable.
     *
     * @param Contact $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Contact $model)
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
            ->minifiedAjax('',"
                data.keyword = $('#keyword').val();
                data.from_date = $('#from_date').val();
                data.to_date = $('#to_date').val();
                data.customers = $('#customers').val();
                data.groups = $('#groups').val();
            ")
            ->addAction(['width' => '120px'])
            ->parameters([
                'dom'     => 'Bfrtip',
                'order'   => [[0, 'desc']],
                'buttons' => [
//                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',]
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
            'name',
            'email',
            'phone',
            'group',
            'created_at',
            'status'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'contactsdatatable_' . time();
    }
}
