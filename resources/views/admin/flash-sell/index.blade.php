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
                  <form>
                    <div class="card-body">
                        <label>Sale End Date</label>
                        <input type="date" name="end_date" class="form-control"
                        value="" >
                    <a href="" class="btn btn-primary mt-4">Save</a>
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
                  <form>
                    <div class="card-body">
                        <label>Sale End Date</label>
                        <select name="" id="" class="form-control select2">
                            <option value="">test1</option>
                            <option value="">test2</option>
                        </select>
                    <a href="" class="btn btn-primary mt-4">Save</a>
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
                  <div class="form-control">
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
