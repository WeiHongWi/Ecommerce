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
                    <h4>Create Slider</h4>
                  </div>
                  <div class="card-body">
                      <form method="POST" action="{{route('admin.slider.store')}}" enctype="multipart/form-data">
                        @csrf
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
                            <input type="text" name="type" class="form-control" >
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Title</label>
                            </div>
                            <input type="text" name="title" class="form-control" >
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Starting Price</label>
                            </div>
                            <input type="text" name="starting_price" class="form-control" >
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Button URL</label>
                            </div>
                            <input type="text" name="btn_url" class="form-control">
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Number</label>
                            </div>
                            <input type="text" name="number" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="inputState">Status</label>
                            <select id="inputState" name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                      </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>




@endsection
