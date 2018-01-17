@extends('.admin/layouts/template')
@section('content')
    <!--start-breadcrumbs-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="{{route('admin_index')}}">Home</a></li>
                    <li class="active">Order</li>
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->
    <!--prdt-starts-->
    <div class="prdt">
        <div class="container">
            <div class="container checkout">
                <div class="cart-items">
                    @if($order->user_id)
                        <p>
                            <h3>User-id:
                                <a  href="{{route('single_user',['id'=>$order->user_id])}}">
                                    {{$order->user_id}}
                                    <br>
                                    <img src="{{asset('images/profile_ava/'.$order->user->avatar)}}">
                                </a>
                            </h3>
                        </p>
                    @endif
                    <p><h3>First name: <span  name="first_name" class="single_value_review order_text">{{$order->first_name}}</span></h3></p>
                    <p><h3>Last name: <span name="last_name" class="single_value_review order_text">{{$order->last_name}}</span></h3></p>
                    <p><h3>Country: <span name="country">
                                {{$order->city->country->name}}
                        </span></h3></p>
                    <p><h3>City: <span  >
                            <select class="selector_order" name="city_id" style="padding:0" data-id="{{$order->id}}" style="padding: 5px;margin-left:-25px;margin-top:25px" class="order_status">
                                @foreach($cities as $city)
                                    <option {{$city->name==$order->city->name ? 'selected' : ''}} value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                        </span></h3></p>
                    <p><h3>Delivery type: <span >
                            <select  class="selector_order" name="delivery_type"  style="padding:0" data-id="{{$order->id}}" style="padding: 5px;margin-left:-25px;margin-top:25px" class="order_status">
                                @foreach($delivery_types as $type)
                                    <option {{$type==$order->delivery_type ? 'selected' : ''}} value="{{$type}}">{{$type}}</option>
                                @endforeach
                            </select>
                        </span></h3></p>
                    <p><h3>Address: <span name="address" class="single_value_review order_text">{{$order->address}}</span></h3></p>
                    <p><h3>Phone: +<span name="phone" class="single_value_review order_text">{{$order->phone}}</span></h3></p>
                    <p><h3>Postal/zip code: <span name="postal_zip" class="single_value_review order_text">{{$order->postal_zip}}</span></h3></p>
                    <p><h3>Order status: <span style="padding-left: 20px" >
                            <select name="order_status" class="selector_order" style="padding:0" data-id="{{$order->id}}" style="padding: 5px;margin-left:-25px;margin-top:25px" class="order_status">
                                @foreach($order_statuses as $order_status)
                                    <option {{$order_status==$order->order_status ? 'selected' : ''}} value="{{$order_status}}">{{$order_status}}</option>
                                @endforeach
                            </select>
                        </span></h3></p>
                    <p><h3>Total order price:$<span id="order_total">{{$order->order_cost}}</span></h3></p>

                    <div style="background: white;min-width: 1000px;" id='orders_table' class="in-check">
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
                            <li></li>
                            <div class="clearfix"></div>
                        </ul>
                        @foreach($order->goods as $good)
                            <ul id="order_href" class="cart-header">
                                <li>
                                    <a href="{{route('admin_single_good',['id'=>$good->good_id])}}"><img class="img-responsive order_goods" src="{{asset('/images/goods/'.$good->image->link)}}" alt=""></a>
                                </li>
                                <li>
                                    <a href="{{route('admin_single_good',['id'=>$good->good_id])}}"><span class="name">{{$good->name}}</span></a>
                                </li>
                                <li>
                                    <span class="name price">${{$good->price}}</span>
                                </li>
                                <li style="text-align: center">
                                    <input data-id="{{$good->good_id}}" data-price="{{$good->price}}" class="good_num name" style="margin-top: 30px ;float: left;height: 30px;max-width: 50px" min="1" type="number" value="{{$good->goods_num}}">
                                </li>
                                <li>
                                    <span id="total_price{{$good->good_id}}" class="name">${{$good->price*$good->goods_num}}</span>
                                </li>
                                <li>
                                    <a href="javascript:;"  data-id="{{$good->good_id}}" class="delete_good" >
                                        <img style="max-width: 40px;" src="{{asset('images/delete1.ico')}}" alt="">
                                    </a>
                                </li>
                                <div class="clearfix"></div>
                            </ul>
                        @endforeach
                        <br>
                        <div id="add_good" style="display:none">
                            <p>Select id of good:</p>
                            <form  id="form_add_good">
                                {{ csrf_field() }}
                            </form>
                        </div>
                        <button class="add_good">Add good</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/admin/order.js')}}"></script>
@endsection