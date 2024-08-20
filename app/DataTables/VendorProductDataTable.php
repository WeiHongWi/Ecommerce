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
            $editbtn = "<a href='".route('vendor.product.edit',$query->id)."'
                        class='btn btn-primary '>Edit</a>";
            $deletebtn = "<a href='".route('vendor.product.destroy',$query->id)."'
                        class='btn btn-danger delete-item' style='margin-left: 4px;'>Delete</a>";

            $managebtn =  "<button type='button' class='btn btn-dark dropdown-toggle' style='margin-left: 4px;'
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
                    return '<i class="badge bg-success">New Arrival</i>';
                    break;
                case 'top_product':
                    return '<i class="badge bg-info">Top Product</i>';
                    break;
                case 'featured_product':
                    return '<i class="badge bg-warning">Featured Product</i>';
                    break;
                case 'best_product':
                    return '<i class="badge bg-danger">Best Product</i>';
                    break;

                default:
                    return '<i class="badge bg-dark">None</i>';
                    break;
            }
        })
        ->addColumn('status',function($query){
            if($query->status == "1"){
                $button = '<div class="form-check form-switch">
                <input checked class="form-check-input" data-id="'.$query->id.'" type="checkbox"
                       role="switch" id="flexSwitchCheckDefault" change-status>
                </div>';

            }else{
                $button = '<div class="form-check form-switch">
                <input class="form-check-input" data-id="'.$query->id.'"  type="checkbox"
                role="switch" id="flexSwitchCheckDefault" change-status>

                </div>';
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
        return $model->where('vendor_id',Auth::user()->id)->newQuery();
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
        return 'VendorProduct_' . date('YmdHis');
    }
}
