@extends('admin.layouts.master')
@section('content')

      <!-- Main Content -->

        <section class="section">
          <div class="section-header">
            <h1>Brand</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Edit Brand</h4>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{route('admin.brand.update',$brand->id)}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Preview</label>
                            <br>
                            <img width="200px" src="{{asset($brand->logo)}}"></img>
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Logo</label>
                            </div>
                            <input type="file" name="logo" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{$brand->name}}">
                        </div>
                        <div class="form-group">
                            <label for="inputState">Feature</label>
                            <select id="inputState" class="form-control" name="feature">
                                <option {{$brand->feature==1 ?'selected':''}} value="1">Yes</option>
                                <option {{$brand->feature==0 ?'selected':''}} value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                                <option {{$brand->status==1 ?'selected':''}} value="1">Active</option>
                                <option {{$brand->status==0 ?'selected':''}} value="0">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Save</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

@endsection
