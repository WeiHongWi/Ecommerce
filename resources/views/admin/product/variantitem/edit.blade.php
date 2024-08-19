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
                    <h4>Edit Variant Item</h4>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{route('admin.variantitem.update',$variantitem->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Variant Name</label>
                            <input type="text" class="form-control" name="var_name"
                                   value="{{$variant->name}}" readonly>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="product_id" value="{{$variant->product_id}}">
                        </div>
                        <div class="form-group">
                            <label>Item Name</label>
                            <input type="text" class="form-control" name="item_name" value="{{$variantitem->item_name}}">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" class="form-control" name="price" value="{{$variantitem->price}}">
                        </div>
                        <div class="form-group">
                            <label for="inputState">Is Default</label>
                            <select id="inputState" class="form-control" name="default">
                                <option>Select</option>
                                <option {{$variantitem->default==1?'selected':''}} value="1">Yes</option>
                                <option {{$variantitem->default==0?'selected':''}} value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                                <option {{$variantitem->status==1?'selected':''}} value="1">Active</option>
                                <option {{$variantitem->status==0?'selected':''}} value="0">Inactive</option>
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

