@extends('./layouts/template')
@section('content')

    <div class="container checkout">
            <div class="cart-items">
                <p><h3>First name: <span class="order_text">{{$order->first_name}}</span></h3></p>
                <p><h3>Last name: <span class="order_text">{{$order->last_name}}</span></h3></p>
                <p><h3>Country: <span class="order_text">{{$order->city->country->name}}</span></h3></p>
                <p><h3>City: <span class="order_text">{{$order->city->name}}</span></h3></p>
                <p><h3>Delivery type: <span class="order_text">{{$order->delivery_type}}</span></h3></p>
                <p><h3>Address: <span class="order_text">{{$order->address}}</span></h3></p>
                <p><h3>Phone: <span class="order_text">+{{$order->phone}}</span></h3></p>
                <p><h3>Postal/zip code: <span class="order_text">{{$order->postal_zip}}</span></h3></p>
                <p><h3>Order status: <span class="order_text">{{$order->order_status}}</span></h3></p>
                <p><h3>Total order price: <span class="order_text">${{$order->order_cost}}</span></h3></p>

                <div id='orders_table' class="in-check">
                    <ul class="unit">
                        <li>
                            <span>Item</span>
                        </li>
                        <li>
                            <span>Product name</span>
                        </li>
                        <li>
                            <span>Unit price</span>
                        </li>
                        <li>
                            <span>Number of items</span>
                        </li>
                        <li>
                            <span>Total price</span>
                        </li>
                        <div class="clearfix"></div>
                    </ul>
                    @foreach($order->goods as $good)
                    <ul id="order_href" class="cart-header">
                        <li>
                            <a href="{{route('single',['alias'=>$good->alias])}}"><img class="img-responsive order_goods" src="{{asset('/images/goods/'.$good->image->link)}}" alt=""></a>
                        </li>
                        <li>
                            <a href="{{route('single',['alias'=>$good->alias])}}"><span class="name">{{$good->name}}</span></a>
                        </li>
                        <li>
                            <span class="name price">${{$good->price}}</span>
                        </li>
                        <li>
                            <span class="name">{{$good->goods_num}}</span>
                        </li>
                        <li>
                            <span class="name">${{$good->price*$good->goods_num}}</span>
                        </li>
                        <div class="clearfix"></div>
                    </ul>
                    @endforeach
                    <br>
                </div>
            </div>
    </div>
@endsection