<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorProductDataTable extends DataTable
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
            $editBtn = "<a href='".route('vendor.products.edit', $query->id)."' class='btn btn-primary'><i class='far fa-edit'></i></a>";
            $deleteBtn = "<a href='".route('vendor.products.destroy', $query->id)."' class='btn btn-danger delete-item' ><i class='far fa-trash-alt'></i></a>";

            $moreBtn = '<div class="btn-group dropstart" style="margin-left:3px">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-cog"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item has-icon" href="'.route('vendor.products-image-gallery.index', ['product' => $query->id]).'"> Thư viện ảnh</a></li>
                    <li><a class="dropdown-item has-icon" href="'.route('vendor.products-variant.index', ['product' => $query->id]).'"> Kích thước, màu sắc</a></li>
                </ul>
            </div>';

            return $editBtn.$deleteBtn.$moreBtn;
        })
        ->addColumn('image', function($query){
            return "<img width='70px' src='".asset($query->thumb_image)."' ></img>";
        })
        ->addColumn('type', function($query){
            switch ($query->product_type) {
                case 'new_arrival':
                    return '<i class="badge bg-success">Hàng mới về</i>';
                    break;
                case 'featured_product':
                    return '<i class="badge bg-warning">Sản phẩm nổi bật</i>';
                    break;
                case 'top_product':
                    return '<i class="badge bg-info">Sản phẩm hàng đầu</i>';
                    break;

                case 'best_product':
                    return '<i class="badge bg-danger">Sản phẩm bán chạy</i>';
                    break;

                default:
                    return '<i class="badge bg-dark">Không có</i>';
                    break;
            }
        })
        ->addColumn('status', function($query){
            if($query->status == 1){

                $button = '<div class="form-check form-switch">
                <input checked class="form-check-input change-status" type="checkbox" id="flexSwitchCheckDefault" data-id="'.$query->id.'"></div>';
            }else {
                $button = '<div class="form-check form-switch">
                <input class="form-check-input change-status" type="checkbox" id="flexSwitchCheckDefault" data-id="'.$query->id.'"></div>';
            }
            return $button;
        })
        ->addColumn('approved', function($query){
            if($query->is_approved === 1){
                return '<i class="badge bg-success">Đã duyệt</i>';
            }else {
                return '<i class="badge bg-warning">Chờ duyệt</i>';
            }
        })
        ->rawColumns(['image', 'type', 'status', 'action', 'approved'])
        ->setRowId('id');

    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('vendor_id', Auth::user()->vendor->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendorproduct-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
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
            Column::make(['data' => 'image', 'title' => 'Ảnh ']),
            Column::make(['data' => 'name', 'title' => 'Tên sản phẩm']),
            Column::make(['data' => 'price', 'title' => 'Giá']),
            Column::make(['data' => 'approved', 'title' => 'Duyệt']),
            Column::make(['data' => 'type', 'title' => 'Loại SP']),
            Column::make(['data' => 'status', 'title' => 'Trạng thái']),
            Column::make(['data' => 'action', 'title' => 'Hành động'])
            ->exportable(false)
            ->printable(false)
            ->width(200)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorProduct_' . date('YmdHis');
    }
}