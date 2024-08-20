<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
                $editbtn = "<a href='".route('admin.product.edit',$query->id)."'
                            class='btn btn-primary'>Edit</a>";
                $deletebtn = "<a href='".route('admin.product.destroy',$query->id)."'
                            class='btn btn-danger ml-3 delete-item'>Delete</a>";

                $managebtn =  "<button type='button' class='btn btn-dark dropdown-toggle' ml-3
                               data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                               <i class='fas fa-cog'></i>
                               </button>
                               <div class='dropdown-menu dropleft' x-placement='left-start' style=
                               'position: absolute; transform: translate3d(-2px, 0px, 0px); top: 0px; left: 0px; will-change: transform;'>
                                <a class='dropdown-item' href='".route('admin.gallery.index',['product' => $query->id])."'>Image Gallery</a>
                                <a class='dropdown-item' href='".route('admin.variant.index',['product' => $query->id])."'>Variants</a>
                            </div>";
                return $editbtn.$deletebtn.$managebtn;
            })
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
            ->addColumn('status',function($query){
                if($query->status == "1"){
                    $button = '<label class="custom-switch mt-2">
                        <input type="checkbox" checked name="custom-switch-checkbox" data-id="'.$query->id.'"
                               class="custom-switch-input change-status">
                        <span class="custom-switch-indicator"></span>
                      </label>';
                }else{
                    $button = '<label class="custom-switch mt-2">
                        <input type="checkbox" name="custom-switch-checkbox" data-id="'.$query->id.'"
                               class="custom-switch-input change-status">
                        <span class="custom-switch-indicator"></span>
                      </label>';
                }
                return $button;
            })
            ->rawColumns(['action','thumb_img','status','type'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('product-table')
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
            Column::make('thumb_img')->width(20),
            Column::make('name')->width(20),
            Column::make('slug')->width(20),
            Column::make('price')->width(20),
            Column::make('status')->width(20),
            Column::computed('action')
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
        return 'Product_' . date('YmdHis');
    }
}
