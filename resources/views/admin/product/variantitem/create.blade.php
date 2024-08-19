@extends('admin.layouts.master')
@section('content')

      <!-- Main Content -->

        <section class="section">
          <div class="section-header">
            <h1>Variant Item</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Create Variant Item</h4>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{route('admin.variantitem.store')}}">
                        @csrf
                        <div class="form-group">
                            <label>Variant Name</label>
                            <input type="text" class="form-control" name="var_name" value="{{$variant->name}}" readonly>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="variant_id" value="{{$variant->id}}">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="product_id" value="{{$product->id}}">
                        </div>
                        <div class="form-group">
                            <label>Item Name</label>
                            <input type="text" class="form-control" name="item_name" value="">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" class="form-control" name="price" value="">
                        </div>
                        <div class="form-group">
                            <label for="inputState">Is Default</label>
                            <select id="inputState" class="form-control" name="default">
                                <option>Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
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

