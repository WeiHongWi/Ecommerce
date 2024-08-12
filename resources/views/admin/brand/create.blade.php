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
                    <h4>Create Brand</h4>
                  </div>
                  <div class="card-body">
                      <form method="POST" action="{{route('admin.brand.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div>
                                <label>Logo</label>
                            </div>
                            <input type="file" name="logo" class="form-control" >
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Name</label>
                            </div>
                            <input type="text" name="name" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="inputState">Is Featured</label>
                            <select id="inputState" name="feature" class="form-control">
                                <option value="">Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
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
