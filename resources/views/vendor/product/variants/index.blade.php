@extends('vendor.dashboard.layouts.master')
@section('content')

<!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Product Variants</h1>
        </div>

        <div class="section-body">
            <div>
                <a href="{{route('vendor.product.index')}}" class="btn btn-primary mb-3 mt-3" style="margin-left: 10px;">Back</a>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Product: {{$product->name}}</h5>
                    <div class="card-header-action">
                        <a href="{{route('vendor.vendor-variant.create',['product' => request()->product])}}"
                           class="btn btn-primary mt-3" style="margin-left:1900px">Create New</a>
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
                    url: "{{route('vendor.vendor-variant.change-status')}}",
                    method: 'PUT',
                    data: {
                        isChecked:isChecked,
                        id:id,
                        '_token': '{{ csrf_token() }}'
                    },
                    //headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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
