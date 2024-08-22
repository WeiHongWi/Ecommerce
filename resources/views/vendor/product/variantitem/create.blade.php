@extends('vendor.dashboard.layouts.master')
@section('content')

      <!-- Main Content -->

        <section class="section">
          <div class="section-header">
            <h1>Create Variant Item</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{route('vendor.vendor-variant-item.store')}}">
                        @csrf
                        <div class="form-group">
                            <label>Variant Name</label>
                            <input type="text" class="form-control" style="margin-bottom: 5px;" name="var_name" value="{{$variant->name}}" readonly>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" style="margin-bottom: 5px;" name="variant_id" value="{{$variant->id}}">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" style="margin-bottom: 5px;" name="product_id" value="{{$product->id}}">
                        </div>
                        <div class="form-group">
                            <label>Item Name</label>
                            <input type="text" class="form-control" style="margin-bottom: 5px;" name="item_name" value="">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" class="form-control" style="margin-bottom: 5px;" name="price" value="">
                        </div>
                        <div class="form-group">
                            <label for="inputState">Is Default</label>
                            <select id="inputState" class="form-control" style="margin-bottom: 5px;" name="default">
                                <option>Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" style="margin-bottom: 5px;" name="status">
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

