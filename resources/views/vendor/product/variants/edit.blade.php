@extends('vendor.dashboard.layouts.master')
@section('content')

      <!-- Main Content -->

        <section class="section">
          <div class="section-header">
            <h1>Variant</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Update Variant</h4>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{route('vendor.vendor-variant.update',$variant->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{$variant->name}}">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="product" value="">
                        </div>
                        <div class="form-group">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Update</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

@endsection

