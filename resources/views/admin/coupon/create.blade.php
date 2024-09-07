@extends('admin.layouts.master')
@section('content')

      <!-- Main Content -->

        <section class="section">
          <div class="section-header">
            <h1>Coupon</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Create Coupon</h4>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{route('admin.coupons.store')}}">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="">
                        </div>

                        <div class="form-group">
                            <label>Code</label>
                            <input type="text" class="form-control" name="code" value="">
                        </div>

                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="text" class="form-control" name="quantity" value="">
                        </div>

                        <div class="form-group">
                            <label>Max Use Per Person</label>
                            <input type="text" class="form-control" name="max_use" value="">
                        </div>

                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" class="form-control" name="start_date" value="">
                        </div>

                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" class="form-control" name="end_date" value="">
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputState">Discount Type</label>
                                    <select id="inputState" class="form-control" name="discount_type">
                                        <option value="1">Percentage</option>
                                        <option value="0">Amount {{$settings->currency_icon}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="inputState">Discount Value</label>
                                    <input type="text" class="form-control" name="discount_value" value="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Create</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('body').on('change','.main-category',function(e){
                let id = $(this).val();
                $.ajax ({
                    method: 'GET',
                    url: "{{route('admin.childcategory.getSubcategory')}}",
                    data: {
                        id:id
                    },
                    success: function(data){
                        console.log(data);
                        //$('.sub-category').append(`<option value="">Select</option>`)
                        $.each(data,function(i,item){
                            $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr,status,error){
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
