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
            <h3><i class="far fa-user"></i> Create Product </h3>
            <div class="wsus__dashboard_profile">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary mb-3" href=""> Create</a>
                </div>
                <form method="POST" action="{{route('vendor.product.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div>
                            <label>Image</label>
                        </div>
                        <input type="file" name="image" class="form-control" >
                    </div>
                    <div class="form-group mt-3">
                        <div>
                            <label>Name</label>
                        </div>
                        <input type="text" name="name" class="form-control" >
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div>
                                    <label for="inputState">Category</label>
                                </div>
                                <select id="inputState" name="category" class="form-control main-category">
                                    <option value="">Select</option>
                                    @foreach ( $categories as $category )
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div>
                                    <label for="inputState">Sub category</label>
                                </div>
                                <select id="inputState" name="subcategory" class="form-control sub-category">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div>
                                    <label for="inputState">Child Category</label>
                                </div>
                                <select id="inputState" name="childcategory" class="form-control child-category">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <div>
                            <label for="inputState">Brand</label>
                        </div>
                        <select id="inputState" name="brand" class="form-control">
                            <option value="">Select</option>
                            @foreach ($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <div>
                            <label>SKU</label>
                        </div>
                        <input type="text" name="sku" class="form-control" value="{{old('sku')}}" >
                    </div>
                    <div class="form-group mt-3">
                        <div>
                            <label>Price</label>
                        </div>
                        <input type="text" name="price" class="form-control" value="{{old('price')}}" >
                    </div>
                    <div class="form-group mt-3">
                        <div>
                            <label>Offer Price</label>
                        </div>
                        <input type="text" name="offer_price" class="form-control" value="{{old('offer_price')}}" >
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                        <div class="form-group">
                            <div>
                                <label>Offer Start Date</label>
                            </div>
                            <input type="date" name="offer_start_date" class="form-control"
                                   value="{{old('offer_start_date')}}" >
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <div>
                                <label>Offer End Date</label>
                            </div>
                            <input type="date" name="offer_end_date" class="form-control"
                                   value="{{old('offer_end_date')}}" >
                        </div>
                    </div>
                    </div>
                    <div class="form-group mt-3">
                        <div>
                            <label>Stock Quantity</label>
                        </div>
                        <input type="text" name="quantity" class="form-control" value="{{old('quantity')}}" >
                    </div>
                    <div class="form-group mt-3">
                        <div>
                            <label>Video Link</label>
                        </div>
                        <input type="text" name="video_link" class="form-control" value="{{old('video_link')}}" >
                    </div>
                    <div class="form-group mt-3">
                        <div>
                            <label>Short Description</label>
                        </div>
                        <textarea class="form-control" name="short_description" ></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <div>
                            <label>Long Description</label>
                        </div>
                        <textarea class="form-control summernote" name="long_description" ></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label for="inputState">Product Type</label>
                        <select id="inputState" class="form-control" name="product_type">
                            <option value="0">Select</option>
                            <option value="new_arrival">New Arrival</option>
                            <option value="featured_product">Featured Product</option>
                            <option value="top_product">Top Product</option>
                            <option value="best_product">Best Product</option>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <div>
                            <label>Seo Title</label>
                        </div>
                        <input class="form-control" name="seo_title" ></input>
                    </div>
                    <div class="form-group mt-3">
                        <div>
                            <label>SEO Description</label>
                        </div>
                        <textarea class="form-control" name="seo_description" ></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <div>
                            <label for="inputState">Status</label>
                        </div>
                        <select id="inputState" name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary mt-3">Submit</button>
                    </div>
                </form>
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
@push('scripts')
<script>
    $(document).ready(function(){
        $('body').on('change','.main-category',function(e){
            let id = $(this).val();
            $.ajax ({
                method: 'GET',
                url: "{{route('vendor.vendor.getSubcategory')}}",
                data: {
                    id:id
                },
                success: function(data){
                    console.log(data);
                    $('.sub-category').html(`<option value="">Select</option>`)
                    $.each(data,function(i,item){
                        $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`)
                    })
                },
                error: function(xhr,status,error){
                    console.log(error);
                }
            })
        })
    })
</script>
<script>
    $(document).ready(function(){
        $('body').on('change','.sub-category',function(e){
            let id = $(this).val();
            $.ajax ({
                method: 'GET',
                url: "{{route('vendor.vendor.getChildcategory')}}",
                data: {
                    id:id
                },
                success: function(data){
                    console.log(data);
                    $('.child-category').html(`<option value="">Select</option>`)
                    $.each(data,function(i,item){
                        $('.child-category').append(`<option value="${item.id}">${item.name}</option>`)
                    })
                },
                error: function(xhr,status,error){
                    console.log(error);
                }
            })
        })
    })
</script>
@endpush
