<?php

namespace App\DataTables;

use App\Models\ProductVariant;
use App\Models\VariantItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VariantItemDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('status', function($query){
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
            ->addColumn('variant name',function($query){
                $variant = ProductVariant::findOrFail($query->variant_id);
                return $variant->name;
            })
            ->addColumn('action',function($query){
                $editbtn = "<a href='".route('admin.variantitem.edit',$query->id)."'
                               class='btn btn-primary'>Edit</a>";
                $deletebtn = "<a href='".route('admin.variantitem.destroy',$query->id)."'
                                 class='btn btn-danger ml-3 delete-item'>Delete</a>";

                return $editbtn.$deletebtn;
            })
            ->addColumn('default',function($query){
                return $query->default?'<i class="badge badge-success">Yes</i>':'<i class="badge badge-danger">No</i>';
            })
            ->rawColumns(['status','action','default'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(VariantItem $model): QueryBuilder
    {
        return $model->where('product_variant_id',request()->variantID)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('variantitem-table')
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
            Column::make('status')->width(20),
            Column::make('default')->width(20),
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
        return 'VariantItem_' . date('YmdHis');
    }
}
