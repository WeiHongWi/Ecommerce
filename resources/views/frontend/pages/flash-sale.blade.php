@extends('frontend.layouts.master')
@section('content')

    <!--============================
        DAILY DEALS START
    ==============================-->
    <section id="wsus__daily_deals">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__section_header rounded-0">
                        <h3>Flash Sale</h3>
                        <div class="wsus__offer_countdown">
                            <span class="end_text">ends time:</span>
                            <div class="simply-countdown simply-countdown-1"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <!--<div class="row flash_sell_slider">-->
                    @foreach ( $items as $item )
                    <div class="col-xl-3 col-sm-6 col-lg-4">
                        <div class="wsus__product_item">
                            <span class="wsus__new">{{producttypeAbbre($item->product->product_type)}}</span>
                            @if (checkDiscount($item->product))
                                <span class="wsus__minus">-{{checkDiscountPercent($item->product)}}%</span>
                            @endif
                            <a class="wsus__pro_link" href="">
                                <img src="{{$item->product->thumb_img}}" alt="product" class="img-fluid w-100 img_1" />
                                <img src="
                                @if (isset($item->product->imagegallery[0]->image))
                                   {{$item->product->imagegallery[0]->image}}
                                @else
                                   {{$item->product->thumb_image}}
                                @endif
                                " alt="product" class="img-fluid w-100 img_2" />-->
                            </a>
                            <ul class="wsus__single_pro_icon">
                                <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                            class="far fa-eye"></i></a></li>
                                <li><a href="#"><i class="far fa-heart"></i></a></li>
                                <li><a href="#"><i class="far fa-random"></i></a>
                            </ul>
                            <div class="wsus__product_details">
                                <a class="wsus__category" href="#">{{$item->product->category->name}} </a>
                                <p class="wsus__pro_rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <span>(133 review)</span>
                                </p>
                                <a class="wsus__pro_name" href="{{route('product-detail',$item->$product->slug)}}">{{$item->product->name}}</a>
                                @if(checkDiscount($item->product))
                                    <p class="wsus__price">{{$settings->currency_icon}}{{$item->product->offer_price}}<del>${{$item->product->price}}</del></p>
                                @else
                                <p class="wsus__price">{{$settings->currency_icon}}{{$item->product->price}}</p>
                                @endif
                                <a class="add_cart" href="#">add to cart</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                <!--</div>-->
            </div>
            @if($items->hasPages())
                {{$items->links()}}
            @endif
        </div>
    </section>
    <!--============================
        DAILY DEALS END
    ==============================-->
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        simplyCountdown('.simply-countdown-1', {
            year: {{date('Y',strtotime($flashsales->end_date))}},
            month: {{date('m',strtotime($flashsales->end_date))}},
            day: {{date('d',strtotime($flashsales->end_date))}},
    });
    })
</script>
@endpush
