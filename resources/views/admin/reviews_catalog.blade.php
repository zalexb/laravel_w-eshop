<div class="prdt-top">
    <div class="col-md-9 prdt-left">
        <div class="product-one">
            @foreach($reviews as $review)
                <div class="col-md-4 product-left p-left">
                    <div class="product-main">
                        <a href="{{route('admin_single_good',['id'=>$review->good->id])}}" class="mask"><img class="img-responsive zoom-img image_link" src="{{asset('images/goods/'.$review->good->image->link)}}" alt="{{$review->good->image->alt}}" /></a>
                        <div class="product-bottom">
                            <h3 class="item_name">{{$review->good->name}}</h3>
                            <p>Explore Now</p>
                            <h4>
                                @if(Request::is('products'))
                                    <a data-id="{{$review->good->id}}" class="item_add a_button{{$review->good->id}}" href="javascript:;">
                                        <i class="button_buy icon{{$review->good->id}}"></i>
                                    </a>
                                @endif
                                <span>$<span class="item_price">{{$review->good->price}}</span></span></h4>
                        </div>
                        @if($review->good->discount_percent)
                            <div class="srch srch1">
                                <span>-{{$review->good->discount_percent}}%</span>
                            </div>
                        @endif
                        <div class="product_review">
                            <div class="product_user">
                                <a href="{{route('single_user',['id'=>$review->user->id])}}">
                                    {{$review->user->first_name}} {{$review->user->last_name}}
                                </a>
                            </div>
                            <div style="padding-bottom: 20px;  " class="review_content">
                                <span style=" overflow-x: hidden;" name="content" data-id="{{$review->id}}" class="single_value_review">{{$review->content}}</span>
                            </div>
                            <a data-id="{{$review->id}}" style="font-size: 135%;color: red;text-transform: uppercase" href="javascript:;" class="review_delete">Delete</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="clearfix"></div>
        <div id="pagin_reviews">
            {{ $reviews->links('my_pagination') }}
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/admin/reviews_catalog.js')}}"></script>