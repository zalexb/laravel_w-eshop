@if(!$goods->isEmpty())
    @foreach($goods as $good)
        <div class="bootstrap-tab-text-grid favorite_single" data-id="{{$good->id}}">
            <div class="bootstrap-tab-text-grid-left">
                <a  href="{{route('admin_single_good',['id'=>$good->id])}}">
                    <img class="img-responsive" src="{{asset('images/goods/'.$good->image->link)}}">
                </a>
            </div>
            <div class="bootstrap-tab-text-grid-right">
                <ul style="padding: 0px;">
                    <li >
                        <a  href="{{route('admin_single_good',['id'=>$good->id])}}">
                            <span class="name">{{$good->name}}</span>
                        </a>
                    </li>
                </ul>
                <p style="overflow-x:hidden">
                <h3>Description:</h3>
                <span name="content" data-id="{{$good->id}}" class="single_value_fav">{{$good->description}}</span>
                </p>
            </div>
            <div class="clearfix"> </div>
        </div>
    @endforeach
    <div id="pagin_favorites">
        {{ $goods->links('my_pagination') }}
    </div>
@else
    <h1 style="padding: 50px;">No favorites!</h1>
@endif
