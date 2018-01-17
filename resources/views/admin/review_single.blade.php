@if(!$reviews->isEmpty())
@foreach($reviews as $review)
    <div class="bootstrap-tab-text-grid review_single" data-id="{{$review->id}}">
        <div class="bootstrap-tab-text-grid-left">
            @if(Request::is('admin/single_user/*'))
                <a  href="{{route('admin_single_good',['id'=>$review->good->id])}}">
                    <img  src="{{asset('images/goods/'.$review->good->image->link)}}" alt=" " class="img-responsive">
                </a>
            @elseif(Request::is('admin/single/*'))
                <a  href="{{route('single_user',['id'=>$review->user->id])}}">
                    <img  src="{{
                        substr($review->user->avatar,0,4)!='http' ? asset('/images/profile_ava/'.($review->user->avatar)) : $review->user->avatar
                    }}" alt=" " class="img-responsive">
                </a>
            @endif
        </div>
        <div class="bootstrap-tab-text-grid-right">
            <ul style="padding: 0px;">
                <li >
                    @if(Request::is('admin/single_user/*'))
                        <a  href="{{route('admin_single_good',['id'=>$review->good->id])}}">
                            {{$review->good->name}}
                        </a>
                    @elseif(Request::is('admin/single/*'))
                        <a  href="{{route('single_user',['id'=>$review->user->id])}}">
                            {{$review->user->first_name}} {{$review->user->last_name}}
                        </a>
                    @endif
                </li>
            </ul>
            <p style="overflow-x:hidden">
                <span name="content" data-id="{{$review->id}}" class="single_value_review">{{$review->content}}</span>
            </p>
        </div>
        <div class="clearfix"> </div>
        <a style="font-size: 135%;color: red;text-transform: uppercase" href="javascript:;" class="review_delete">Delete</a>
    </div>
@endforeach
<div id="pagin_reviews">
    {{ $reviews->links('my_pagination') }}
</div>
@else
    <h1 style="padding: 50px;">No reviews!</h1>
@endif
@if(Request::is('admin/single_user/*'))
    <script src="{{asset('js/admin/review_user.js')}}"></script>
@else
    <script src="{{asset('js/admin/review_single.js')}}"></script>@endif
