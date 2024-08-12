@extends('admin.layouts.master')
@section('content')

      <!-- Main Content -->

        <section class="section">
          <div class="section-header">
            <h1>Vendor Profile</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Update Vendor Profile</h4>
                  </div>
                  <div class="card-body">
                      <form method="POST" action="{{route('admin.vendor.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div>
                                <label>Preview</label>
                            </div>
                            <img src="{{asset($profile->banner)}}" width="200px">
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Banner</label>
                            </div>
                            <input type="file" name="banner" class="form-control" >
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Phone</label>
                            </div>
                            <input type="text" name="phone" class="form-control" value="{{$profile->phone}}" >
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Email</label>
                            </div>
                            <input type="email" name="email" class="form-control" value="{{$profile->email}}">
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Address</label>
                            </div>
                            <input type="text" name="address" class="form-control" value="{{$profile->address}}">
                        </div>
                        <div class="form-group">
                            <div>
                                <label>FB link</label>
                            </div>
                            <input type="text" name="fb_link" class="form-control" value="{{$profile->fb_link}}">
                        </div>
                        <div class="form-group">
                            <div>
                                <label>IG link</label>
                            </div>
                            <input type="text" name="ig_link" class="form-control" value="{{$profile->ig_link}}">
                        </div>
                        <div class="form-group">
                            <div>
                                <label>X link</label>
                            </div>
                            <input type="text" name="x_link" class="form-control" value="{{$profile->x_link}}">
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Description</label>
                            </div>
                            <textarea class="summernote" name="description" >{{$profile->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Update</button>
                        </div>
                      </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>




@endsection
