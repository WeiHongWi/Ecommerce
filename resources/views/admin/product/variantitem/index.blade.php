@extends('admin.layouts.master')
@section('content')

<!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Variant Items</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Variant Item</h2>
            <div>
                <a href="{{route('admin.variant.index',['product' => $product->id])}}" class="btn btn-primary mb-3">Back</a>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Product: {{$product->name}} -- {{$variant->name}}</h4>
                    <div class="card-header-action">
                        <a href="{{route('admin.variantitem.create',['productID'=>$product->id,
                                'variantID' => $variant->id])}}" class="btn btn-primary">Create New</a>
                    </div>
                  </div>
                  <div class="card-body">
                      {{$dataTable->table()}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        $(document).ready(function(){
            $('body').on('click','.change-status',function(){

                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{route('admin.variantitem.change-status')}}",
                    method: 'PUT',
                    data: {
                        isChecked:isChecked,
                        id:id
                    },
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(data){
                        console.log(data);
                    },
                    error: function(xhr,status,error){
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
