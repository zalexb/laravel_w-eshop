@if(!$favorites->isEmpty())
    @foreach($favorites as $fav_good)
        <div class="bootstrap-tab-text-grid favorite_single" data-id="{{$fav_good->id}}">
            <div class="bootstrap-tab-text-grid-left">
                    <a  href="{{route('admin_single_good',['id'=>$fav_good->id])}}">
                        <img class="img-responsive" src="{{asset('images/goods/'.$fav_good->image->link)}}">
                    </a>
            </div>
            <div class="bootstrap-tab-text-grid-right">
                <ul style="padding: 0px;">
                    <li >
                            <a  href="{{route('admin_single_good',['id'=>$fav_good->id])}}">
                                <span class="name">{{$fav_good->name}}</span>
                            </a>
                    </li>
                </ul>
                <p style="overflow-x:hidden">
                    <h3>Description:</h3>
                    <span name="content" data-id="{{$fav_good->id}}" class="single_value_fav">{{$fav_good->description}}</span>
                </p>
            </div>
            <div class="clearfix"> </div>
            <a style="font-size: 135%;color: red;text-transform: uppercase" href="javascript:;" class="favorite_delete">Delete</a>
        </div>
    @endforeach
    <div id="pagin_favorites">
        {{ $favorites->links('my_pagination') }}
    </div>
@else
    <h1 style="padding: 50px;">No favorites!</h1>
@endif
<script src="{{asset('js/admin/favorite_single.js')}}"></script>
