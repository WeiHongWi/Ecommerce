<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
@extends('vendor.dashboard.layouts.master')
@section('content')
<!--=============================
    DASHBOARD START
  ==============================-->
  <section id="wsus__dashboard">
    <div class="container-fluid">
      @include('vendor.dashboard.layouts.sidebar')
      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> shop profile</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <form method="POST" action="{{route('vendor.shop-profile.store')}}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <div>
                                <label>Preview</label>
                            </div>
                            <img src="{{asset($profile->banner)}}" width="200px">
                        </div>
                        <div class="form-group">
                            <label>Banner</label>
                            <input type="file" name="banner" class="form-control" >
                        </div>
                        <div class="wsus__input">
                            <label>Shop Name</label>
                            <input type="text" name="shop_name" class="form-control" value="{{$profile->shop_name}}" >
                        </div>
                        <div class="wsus__input">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{$profile->phone}}" >
                        </div>
                        <div class="wsus__input">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{$profile->email}}">
                        </div>
                        <div class="wsus__input">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" value="{{$profile->address}}">
                        </div>

                        <div class="wsus__input">
                            <label>FB link</label>
                            <input type="text" name="fb_link" class="form-control" value="{{$profile->fb_link}}">
                        </div>
                        <div class="wsus__input">
                            <label>IG link</label>
                            <input type="text" name="ig_link" class="form-control" value="{{$profile->ig_link}}">
                        </div>
                        <div class="wsus__input">
                            <label>X link</label>
                            <input type="text" name="x_link" class="form-control" value="{{$profile->x_link}}">
                        </div>
                        <div class="wsus__input">
                            <div class="mt-2">
                                <label>Description</label>
                            </div>
                            <textarea class="summernote" name="description" >{{$profile->description}}</textarea>
                        </div>
                    <div class="wsus__input">
                        <button class="btn btn-primary mt-3">Update</button>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--=============================
    DASHBOARD START
  ==============================-->
@endsection
