@extends('admin.layouts.master')
@section('content')

<!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Seller Product</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Seller Product</h2>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>All Products</h4>
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
                    url: "{{route('admin.product.change-status')}}",
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
            $('body').on('change','.is_approved',function(){
                let val = $(this).val();
                let id = $(this).data('id');

                $.ajax({
                    url: "{{route('admin.pending-seller.change-approved')}}",
                    method: 'PUT',
                    data: {
                        id:id,
                        value:val,
                    },
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(data){
                        console.log(data);
                        window.location.reload();
                    },
                    error: function(xhr,status,error){
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
