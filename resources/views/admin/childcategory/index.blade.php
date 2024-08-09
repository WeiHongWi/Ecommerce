@extends('admin.layouts.master')
@section('content')
      <!-- Main Content -->

      <section class="section">
        <div class="section-header">
          <h1>Child Category</h1>
        </div>

        <div class="section-body">
          <h2 class="section-title">Child Category</h2>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>All Child Categories</h4>
                  <div class="card-header-action">
                      <a href="{{route('admin.childcategory.create')}}" class="btn btn-primary">Create New</a>
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
                    url: "{{route('admin.childcategory.change-status')}}",
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
