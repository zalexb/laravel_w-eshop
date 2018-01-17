<div class="prdt-top">
    <div class="col-md-9 prdt-left">
        <div class="product-one">
            @foreach($goods_paginated as $good)
                <div class="col-md-4 product-left p-left">
                    <div class="product-main">
                        <a href="{{route('single',['alias'=>$good->alias])}}" class="mask"><img class="img-responsive zoom-img image_link" src="{{asset('images/goods/'.$good->image->link)}}" alt="{{$good->image->alt}}" /></a>
                        <div class="product-bottom">
                            <h3  class="item_name">{{$good->name}}</h3>
                            <p>Explore Now</p>
                            <h4>
                                    @if(Request::is('products'))
                                    <a data-id="{{$good->id}}" alias="{{$good->alias}}" class="item_add a_button{{$good->id}}" href="javascript:;">
                                        <i class="button_buy icon{{$good->id}}"></i>
                                    </a>
                                    @endif
                                        <span>$<span class="item_price">{{$good->price}}</span></span></h4>
                        </div>
                        @if($good->discount_percent)
                            <div class="srch srch1">
                                <span>-{{$good->discount_percent}}%</span>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="clearfix"></div>
        <div id="pagin">
            {{ $goods_paginated->links('my_pagination')}}
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/paginate_ajax.js')}}"></script>