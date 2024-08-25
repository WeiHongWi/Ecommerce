@extends('admin.layouts.master')
@section('content')

<!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Flash Sell</h1>
        </div>
        <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Flash Sales End Date</h4>
                  </div>
                  <form action="{{route('admin.flash-sale.update')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <label>Sale End Date</label>
                        <input type="date" name="end_date" class="form-control"
                        value="">
                    <button type="submit" class="btn btn-primary mt-4">Save</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Add Flash Sales Product</h4>
                  </div>
                  <form action="{{route('admin.flash-sale.addProduct')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <label>Add Product</label>
                        <select name="product_id" id="" class="form-control select2">
                            @foreach ($products as $product )
                                <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mt-3">
                                    <div>
                                        <label> Show at home</label>
                                    </div>
                                    <select name="show_home" id="" class="form-control">
                                        <option value="">Select</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mt-3">
                                    <div>
                                        <label> Status</label>
                                    </div>
                                    <select name="status" id="" class="form-control">
                                        <option value="">Select</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Save</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>All Flash Sales</h4>
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
                    url: "{{route('admin.flash-sale.changeStatus')}}",
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

            $('body').on('click','.change-status-home',function(){

                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                        url: "{{route('admin.flash-sale.changeStatusHome')}}",
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
