<div class="prdt-top">
    <div class="col-md-9 prdt-left">
        <div class="product-one">
            @foreach($orders as $order)
                <div class="col-md-4 product-left p-left">
                    <div class="product-main">
                        @if($order->user_id)
                        <a href="{{route('admin_order',['id'=>$order->id])}}" class="mask">
                           <img class="img-responsive zoom-img image_link" src="{{asset('images/profile_ava/'.$order->user->avatar)}}" alt="" />
                            <h3 class="item_name">{{$order->first_name}}
                            {{$order->last_name}}</h3>
                        </a>
                        @endif
                        <div class="product-bottom">
                            <a href="{{route('admin_order',['id'=>$order->id])}}" class="mask">
                                <h3 class="item_name">Order id: {{$order->id}}</h3>
                            </a>
                            <h4>
                                <span>Price: $<span class="item_price">{{$order->order_cost}}</span></span></h4>
                                <span><span class="item_price">Status: {{$order->order_status}}</span></span></h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="clearfix"></div>
        <div id="pagin">
            {{ $orders->links('my_pagination') }}
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/admin/orders_catalog.js')}}"></script>