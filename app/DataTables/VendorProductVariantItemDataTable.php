<?php

namespace App\DataTables;

use App\Models\ProductVariant;
use App\Models\VariantItem;
use App\Models\VendorProductVariantItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorProductVariantItemDataTable extends DataTable
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
                $editbtn = "<a href='".route('vendor.vendor-variant-item.edit',
                            ['variantID' => $query->id])."' class='btn btn-primary' style='margin-right:3px;'>Edit</a>";
                $deletebtn = "<a href='' class='btn btn-danger'>Delete</a>";
                return $editbtn.$deletebtn;
            })
            ->addColumn('variant name',function($query){
                $variant = ProductVariant::findOrFail($query->product_variant_id);
                return $variant->name;
            })
            ->addColumn('status', function($query){
                if($query->status == "1"){
                    $button = '<div class="form-check form-switch">
                    <input checked class="form-check-input change-status" data-id="'.$query->id.'" type="checkbox"
                           role="switch" id="flexSwitchCheckDefault">
                    </div>';
                }else{
                    $button = '<div class="form-check form-switch" change-status>
                    <input class="form-check-input change-status" data-id="'.$query->id.'" type="checkbox"
                    role="switch" id="flexSwitchCheckDefault">
                    </div>';
                }
                return $button;
            })
            ->addColumn('default',function($query){
                return $query->default?'<i class="bg bg-info">Yes</i>':'<i class="bg bg-danger">No</i>';
            })
            ->rawColumns(['status','action','default'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(VariantItem $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendorproductvariantitem-table')
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
            Column::make('variant name')->width(20),
            Column::make('item_name')->width(20),
            Column::make('price')->width(20),
            Column::make('default')->width(20),
            Column::make('status')->width(20),
            Column::computed('action')
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
        return 'VendorProductVariantItem_' . date('YmdHis');
    }
}
