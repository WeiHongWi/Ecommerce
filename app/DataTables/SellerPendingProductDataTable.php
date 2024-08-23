<?php

namespace App\DataTables;

use App\Models\Product;
use App\Models\SellerPendingProduct;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SellerPendingProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('thumb_img',function($query){
            $img = "<img src='".asset($query->thumb_img)."' width=100px></img>";
            return $img;
        })
        ->addColumn('type', function($query){
            switch($query->product_type){
                case 'new_arrival':
                    return '<i class="badge badge-success">New Arrival</i>';
                    break;
                case 'top_product':
                    return '<i class="badge badge-info">Top Product</i>';
                    break;
                case 'featured_product':
                    return '<i class="badge badge-warning">Featured Product</i>';
                    break;
                case 'best_product':
                    return '<i class="badge badge-danger">Best Product</i>';
                    break;

                default:
                    return '<i class="badge badge-dark">None</i>';
                    break;
            }
        })
        ->addColumn('vendor',function($query){
            $product = Product::findOrFail($query->id);
            return $product->vendor->shop_name;
        })
        ->addColumn('approved',function($query){
            return "<select class='form-control is_approved' data-id='".$query->id."'>
            <option value='0' ".($query->is_approved == '0' ? 'selected' : '').">Pending</option>
            <option value='1' ".($query->is_approved == '1' ? 'selected' : '').">Approved</option>
            </select>";
        })
        ->rawColumns(['thumb_img','type','approved'])
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('is_approved',0)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('sellerpendingproduct-table')
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
            Column::make('id')->width(20),
            Column::make('type')->width(20),
            Column::make('vendor')->width(20),
            Column::make('thumb_img')->width(20),
            Column::make('name')->width(20),
            Column::make('price')->width(20),
            Column::make('approved')->width(20),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'SellerPendingProduct_' . date('YmdHis');
    }
}
