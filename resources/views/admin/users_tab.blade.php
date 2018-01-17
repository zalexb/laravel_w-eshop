@if(!$users->isEmpty())
    @foreach($users as $user)
        <div class="bootstrap-tab-text-grid review_single" data-id="{{$user->id}}">
            <div class="bootstrap-tab-text-grid-left">
                <a class="detach_user_role" data-id="{{$user->id}}" href="javascript:;">
                    <img src="{{asset('images/delete1.ico')}}" style="max-width: 30px;max-height: 30px;position:relative;z-index: 5;top:30px;left:130px">
                </a>
                <img class="img-responsive zoom-img image_link" src="{{asset('images/profile_ava/'.$user->avatar)}}"/>
                <a href="{{route('single_user',['id'=>$user->id])}}" class="mask">
                <div class="product-bottom">
                    <h3 class="item_name">Id:{{$user->id}}</h3>
                    <h3 class="item_name">{{$user->first_name}} {{$user->last_name}}</h3>
                </div>
                </a>
            </div>
            <div class="clearfix"> </div>

        </div>
    @endforeach
    <div id="pagin_users">
        {{ $users->links('my_pagination') }}
    </div>
@else
    <h1 style="padding: 50px;">No users!</h1>
@endif
    <script src="{{asset('js/admin/role_users.js')}}"></script>

