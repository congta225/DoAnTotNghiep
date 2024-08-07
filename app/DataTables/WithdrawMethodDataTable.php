<?php

namespace App\DataTables;

use App\Models\WithdrawMethod;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class WithdrawMethodDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query){
                $editBtn = "<a href='".route('admin.withdraw-method.edit', $query->id)."' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='".route('admin.withdraw-method.destroy', $query->id)."' class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";

                return $editBtn.$deleteBtn;
            })

            ->addColumn('minimum_amount', function($query){
                return number_format($query->minimum_amount,0,'.','.').'đ';
            })

            ->addColumn('maximum_amount', function($query){
                return number_format($query->maximum_amount,0,'.','.').'đ';
            })

            ->addColumn('withdraw_charge', function($query){
                return $query->withdraw_charge.'%';
            })

            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(WithdrawMethod $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('withdrawmethod-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make(['data' => 'name', 'title' => 'Tên phương thức']),
            Column::make(['data' => 'minimum_amount', 'title' => 'Số tiền tối thiểu/ngày']),
            Column::make(['data' => 'maximum_amount', 'title' => 'Số tiền tối đa/ngày']),
            Column::make(['data' => 'withdraw_charge', 'title' => 'Phí rút tiền']),
            Column::make(['data' => 'action', 'title' => 'Hành động'])
            ->exportable(false)
            ->printable(false)
            ->width(100)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'WithdrawMethod_' . date('YmdHis');
    }
}
