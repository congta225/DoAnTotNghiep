<?php

namespace App\DataTables;

use App\Models\WithdrawRequest;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class WithdrawRequestDataTable extends DataTable
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
                $showBtn = "<a href='".route('admin.withdraw.show', $query->id)."' class='btn btn-primary'><i class='far fa-eye'></i></a>";

                return $showBtn;
            })
            ->addColumn('status', function($query){
                if($query->status == 'pending'){
                    return "<span class='badge bg-warning'>Chờ xử lý</span>";
                }elseif($query->status == 'paid'){
                    return "<span class='badge bg-success'>Đã trả</span>";
                }else {
                    return "<span class='badge bg-danger'>Từ chối</span>";
                }
            })
            ->addColumn('total_amount', function($query){
                return $query->total_amount.getCurrencyIcon();
            })
            ->addColumn('withdraw_amount', function($query){
                return $query->withdraw_amount.getCurrencyIcon();
            })
            ->addColumn('withdraw_charge', function($query){
                return $query->withdraw_charge.getCurrencyIcon();
            })
            ->addColumn('vendor', function($query){
                return $query->vendor->shop_name;
            })
            ->filterColumn('vendor', function($query, $keyword){
                $query->whereHas('vendor', function($subQuery) use ($keyword){
                    $subQuery->where('shop_name', 'like', '%'.$keyword.'%');
                });
            })
            ->addColumn('date', function($query){
                return date('d M Y', strtotime($query->created_at));
            })
            ->rawColumns(['action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(WithdrawRequest $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('withdrawrequest-table')
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
            Column::make(['data' => 'vendor', 'title' => 'Tên nhà cung cấp']),
            Column::make(['data' => 'method', 'title' => 'Hình thức rút tiền']),
            Column::make(['data' => 'total_amount', 'title' => 'Tổng cộng']),
            Column::make(['data' => 'withdraw_amount', 'title' => 'Số tiền rút được']),
            Column::make(['data' => 'withdraw_charge', 'title' => 'Phí rút tiền']),
            Column::make(['data' => 'status', 'title' => 'Trạng thái']),
            Column::make(['data' => 'date', 'title' => 'Ngày rút']),
            Column::make(['data' => 'action', 'title' => 'Hành động'])
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'WithdrawRequest_' . date('YmdHis');
    }
}
