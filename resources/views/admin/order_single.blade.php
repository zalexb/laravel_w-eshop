
    @if(!$orders->isEmpty())
        <div class="cart-items">
            <div id='orders_table' class="in-check">
                <ul class="unit">
                    <li>
                        <span>Id</span>
                    </li>
                    <li>
                        <span>Status</span>
                    </li>
                    <li>
                        <span>Delivery type</span>
                    </li>
                    <li>
                        <span>Created at</span>
                    </li>
                    <li>
                        <span>Total cost</span>
                    </li>
                    <div class="clearfix"></div>
                </ul>
                @foreach($orders as $order)
                        <ul id="order_href" class="cart-header" >
                            <li>
                                <a href="{{route('admin_order',['id'=>$order->id])}}">
                                    <span class="name">{{$order->id}}</span>
                                </a>
                            </li>
                            <li>
                                <select data-id="{{$order->id}}" style="padding: 5px;margin-left:-25px;margin-top:25px" class="order_status">
                                    @foreach($order_statuses as $order_status)
                                         <option {{$order_status==$order->order_status ? 'selected' : ''}} value="{{$order_status}}">{{$order_status}}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li>
                                <span class="name">{{$order->delivery_type}}</span>
                            </li>
                            <li>
                                <span class="name">{{$order->created_at}}</span>
                            </li>
                            <li>
                                <span class="name">${{$order->order_cost}}</span>
                            </li>

                            <div class="clearfix"></div>
                        </ul>
                @endforeach
                <div id="pagin_orders">
                    {{ $orders->links('my_pagination') }}
                </div>
            </div>
        </div>
    @else
        <h1 style="padding: 50px;">No orders!</h1>
    @endif
    @if(Request::is('admin/single_user/*'))
        <script src="{{asset('js/admin/order_user.js')}}"></script>
    @else
        <script src="{{asset('js/admin/order_single.js')}}"></script>
    @endif
