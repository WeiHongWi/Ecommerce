@extends('admin.layouts.master')
@section('content')

      <!-- Main Content -->

        <section class="section">
          <div class="section-header">
            <h1>Slider</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Edit Slider</h4>
                  </div>
                  <div class="card-body">
                      <form method="POST" action="{{route('admin.slider.update',$slider->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Preview</label>
                            <br>
                            <img width="200px" src="{{asset($slider->banner)}}"></img>
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Banner</label>
                            </div>
                            <input type="file" name="banner" class="form-control" >
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Type</label>
                            </div>
                            <input type="text" name="type" class="form-control" value="{{$slider->type}}" >
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Title</label>
                            </div>
                            <input type="text" name="title" class="form-control" value="{{$slider->title}}" >
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Starting Price</label>
                            </div>
                            <input type="text" name="starting_price" class="form-control" value="{{$slider->starting_price}}" >
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Button URL</label>
                            </div>
                            <input type="text" name="btn_url" class="form-control" value="{{$slider->btn_url}}">
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Number</label>
                            </div>
                            <input type="text" name="number" class="form-control" value="{{$slider->number}}">
                        </div>
                        <div class="form-group">
                            <label for="inputState">Status</label>
                            <select id="inputState" name="status" class="form-control">
                                <option {{$slider->status==1?'selected':''}} value="1">Active</option>
                                <option {{$slider->status==0?'selected':''}} value="0">Inactive</option>
                            </select>
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
