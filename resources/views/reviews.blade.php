@extends('./layouts/template')
@section('content')
    <div class="container checkout">
        @if(!$reviews->isEmpty())
            <div class="cart-items">
                <h2>
                    @if($reviews[0]->user->id!=unserialize(request()->cookie('prof'))['id'])
                    {{$reviews[0]->user->first_name}}'s
                    @else
                        My
                    @endif
                     Reviews</h2>
                <div id='orders_table' class="in-check">
                    <ul class="unit">
                        <li>
                            <span>Item</span>
                        </li>
                        <li>
                            <span>Name</span>
                        </li>
                        <li>
                            <span>Message</span>
                        </li>
                        <div class="clearfix"></div>
                    </ul>
                    @foreach($reviews as $review)
                        <a  href="{{route('single',['alias'=>$review->good->alias])}}">
                            <ul id="order_href" class="cart-header">
                                <li>
                                    <img class="img-responsive" src="{{asset('images/goods/'.$review->good->image->link)}}">
                                </li>
                                <li>
                                    <span class="name">{{$review->good->name}}</span>
                                </li>
                                <li style="width: auto;max-width: 600px;height: auto">
                                    <span style="overflow-x: hidden;" class="name">{{$review->content}}</span>
                                </li>
                                <div class="clearfix"></div>
                            </ul>
                        </a>
                    @endforeach
                    <div id="pagin">
                        {{ $reviews->links('my_pagination') }}
                    </div>
                </div>
            </div>
        @else
            <h1 style="padding: 50px;">No reviews!</h1>
        @endif
    </div>

@endsection