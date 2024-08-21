@extends('vendor.dashboard.layouts.master')
@section('content')

<!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Product Image Gallery</h1>
        </div>

        <div class="section-body">
            <div>
                <a href="{{route('vendor.product.index')}}" class="btn btn-primary mb-3">Back </a>
            </div>
            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h4>Product : {{$product->name}}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('vendor.vendor-product-gallery.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Image <code>(Multiple Image Supported!!)</code></label>
                                <input type="file" name="image[]" class="form-control" multiple>
                                <input type="hidden" name="product" value="{{$product->id}}" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 ml-3">Upload</button>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>All Images</h4>
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
        })
    </script>
@endpush
