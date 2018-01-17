@extends('./layouts/template')
@section('content')
    <div class="container checkout">
    @if(!$favorites->isEmpty())
        <div class="cart-items">
            <h2>
                @if($user->id!=unserialize(request()->cookie('prof'))['id'])
                    {{$user->first_name}}'s
                @else
                    My
                @endif
                Favorites</h2>
            <div id='orders_table' class="in-check">
                <ul class="unit">
                    <li>
                        <span>Item</span>
                    </li>
                    <li>
                        <span>Name</span>
                    </li>
                    <li>
                        <span>Price</span>
                    </li>
                    <li>
                        <span>Description</span>
                    </li>
                    <div class="clearfix"></div>
                </ul>
                @foreach($favorites as $good)
                    <a  href="{{route('single',['alias'=>$good->alias])}}">
                        <ul id="order_href" class="cart-header">
                            <li>
                                <img class="img-responsive" src="{{asset('images/goods/'.$good->image->link)}}">
                            </li>
                            <li>
                                <span class="name">{{$good->name}}</span>
                            </li>
                            <li>
                                <span class="cost">${{$good->price}}</span>
                            </li>
                            <li style="width: auto;max-width: 600px;height: auto;width: 40%;">
                                <span style="overflow-x: hidden;" class="name">{{$good->description}}</span>
                            </li>
                            <div class="clearfix"></div>
                        </ul>
                    </a>
                @endforeach
                <div id="pagin">
                    {{ $favorites->links('my_pagination') }}
                </div>
            </div>
        </div>
    @else
        <h1 style="padding: 50px;">No Favorites!</h1>
    @endif
    </div>
@endsection