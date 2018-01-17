<div class="prdt-top">
    <div class="col-md-9 prdt-left">
        <div class="product-one">
            @foreach($users as $user)
            <div class="col-md-4 product-left p-left">
                <div class="product-main">
                    <a href="{{route('single_user',['id'=>$user->id])}}" class="mask"><img class="img-responsive zoom-img image_link" src="{{asset('images/profile_ava/'.$user->avatar)}}"/></a>
                    <div class="product-bottom">
                        <h3 class="item_name">{{$user->first_name}} {{$user->last_name}}</h3>
                    </div>
                    <div class="product-bottom">
                        Roles: <span class="item_name">
                        @foreach($user->roles as $role)
                        {{$role->name}}
                        @endforeach
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="clearfix"></div>
        <div id="pagin">
            {{ $users->links('my_pagination') }}
        </div>
    </div>
</div>
<script src="{{asset('js/admin/users.js')}}"></script>