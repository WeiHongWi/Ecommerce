@extends('admin.layouts.master')
@section('content')

      <!-- Main Content -->

        <section class="section">
          <div class="section-header">
            <h1>Shipping Rule</h1>
          </div>

          <div class="section-body">
            <h2 class="section-title">Shipping Rule</h2>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-header-action">
                        <a href="{{route('admin.shipping-rule.create')}}" class="btn btn-primary">Create New</a>
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
        $('body').on('change','.change-status',function(){
            let id = $(this).data('id');
            let isChecked = $(this).is(':checked');

            $.ajax({
                    url: "{{route('admin.shipping-rule.change-status')}}",
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
