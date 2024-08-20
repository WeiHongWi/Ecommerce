@extends('admin.layouts.master')
@section('content')

<!-- Main Content -->

<section class="section">
    <div class="section-header">
        <h1>Product</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Edit Product</h4>
                  </div>
                  <div class="card-body">
                      <form method="POST" action="{{route('vendor.product.update',$product->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <div>
                                <label>Preview</label>
                            </div>
                            <img src="{{asset($product->thumb_img)}}" width="200px" >
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Image</label>
                            </div>
                            <input type="file" name="image" class="form-control" >
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Name</label>
                            </div>
                            <input type="text" name="name" class="form-control" value="{{$product->name}}" >
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div>
                                        <label for="inputState">Category</label>
                                    </div>
                                    <select id="inputState" name="category" class="form-control main-category">
                                        <option value="">Select</option>
                                        @foreach ( $categories as $category )
                                            <option {{($category->id == $product->category_id ? 'selected':'')}} value="{{$category->id}}">{{$category->name}}</option>
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

                        <div class="form-group">
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

                        <div class="form-group">
                            <div>
                                <label>SKU</label>
                            </div>
                            <input type="text" name="sku" class="form-control" value="{{$product->sku}}" >
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Price</label>
                            </div>
                            <input type="text" name="price" class="form-control" value="{{$product->price}}" >
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Offer Price</label>
                            </div>
                            <input type="text" name="offer_price" class="form-control" value="{{$product->offer_price}}" >
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <label>Offer Start Date</label>
                                </div>
                                <input type="date" name="offer_start_date" class="form-control"
                                       value="{{$product->offer_start_date}}" >
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <label>Offer End Date</label>
                                </div>
                                <input type="date" name="offer_end_date" class="form-control"
                                       value="{{$product->offer_end_date}}" >
                            </div>
                        </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Stock Quantity</label>
                            </div>
                            <input type="text" name="quantity" class="form-control" value="{{$product->quantity}}" >
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Video Link</label>
                            </div>
                            <input type="text" name="video_link" class="form-control" value="{{$product->video_link}}" >
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Short Description</label>
                            </div>
                            <textarea class="form-control" name="short_description" >{!! $product->short_description !!}</textarea>
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Long Description</label>
                            </div>
                            <textarea class="form-control summernote" name="long_description" >{!! $product->long_description !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputState">Product Type</label>
                            <select id="inputState" class="form-control" name="product_type">
                                <option value="0">Select</option>
                                <option {{($product->product_type=='new_arrival')?'selected':''}} value="new_arrival">New Arrival</option>
                                <option {{($product->product_type=='featured_product')?'selected':''}} value="featured_product">Featured Product</option>
                                <option {{($product->product_type=='top_product')?'selected':''}} value="top_product">Top Product</option>
                                <option {{($product->product_type=='best_product')?'selected':''}} value="best_product">Best Product</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Seo Title</label>
                            </div>
                            <input class="form-control" name="seo_title" value="{{$product->seo_title}}" ></input>
                        </div>
                        <div class="form-group">
                            <div>
                                <label>SEO Description</label>
                            </div>
                            <textarea class="form-control" name="seo_description">{!!$product->seo_description!!}</textarea>
                        </div>
                        <div class="form-group">
                            <div>
                                <label for="inputState">Status</label>
                            </div>
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
