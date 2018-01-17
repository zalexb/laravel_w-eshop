@extends('./layouts/template')
@section('content')

<div class="container checkout">
    @if(!$orders->isEmpty())
    <div class="cart-items">
        <h2>My Orders</h2>
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
                <a  href="{{route('single_order',['user_id'=>unserialize(request()->cookie('prof'))['id'],'order_id'=>$order->id])}}">
                <ul id="order_href" class="cart-header">
                   <li>
                       <span class="name">{{$order->id}}</span>
                   </li>
                    <li>
                        <span class="name">{{$order->order_status}}</span>
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
                </a>
            @endforeach
            <div id="pagin">
                {{ $orders->links('my_pagination') }}
            </div>
        </div>
    </div>
    @else
        <h1 style="padding: 50px;">You have no orders!</h1>
    @endif
</div>

@endsection