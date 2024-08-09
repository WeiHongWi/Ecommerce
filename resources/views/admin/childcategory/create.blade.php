@extends('admin.layouts.master')
@section('content')

      <!-- Main Content -->

        <section class="section">
          <div class="section-header">
            <h1>Category</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Create Category</h4>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{route('admin.childcategory.store')}}">
                        @csrf
                        <div class="form-group">
                            <div>
                                <label for="inputState">Category</label>
                            </div>
                            <select id="inputState" class="form-contorl main-category" name="category">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div>
                                <label for="inputState">Sub Category</label>
                            </div>
                            <select id="inputState" class="form-contorl sub-category" name="subcategory">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="">
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
                    url: "{{route('admin.childcategory.getSubacategory')}}",
                    data: {
                        id:id
                    },
                    success: function(data){
                        console.log(data);
                        $('.sub-category').append(`<option value="">Select</option>`)
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
