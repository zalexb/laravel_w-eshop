<div class="top-header">
    <div class="container">
        <div class="top-header-main">
            <div class="col-md-6 top-header-left">
                @if(unserialize(request()->cookie('prof'))['avatar'])
                    <div id="profile_container">
                        <a id="profile_drop" href="javascript:;">

                            <img class="header_avatar" src="{{

                            substr(unserialize(request()->cookie('prof'))['avatar'],0,4)!='http' ? asset('/images/profile_ava/'.(unserialize(request()->cookie('prof'))['avatar'])) : unserialize(request()->cookie('prof'))['avatar']

                            }}" alt="">

                            <img class='profile_arrow' src="{{asset('/images/arrow1.png')}}" alt="">
                        </a>
                        <span style="padding-left: 10px;color:white">Hello, {{unserialize(request()->cookie('prof'))['first_name']}}!</span>
                    </div>
                @else
                    <div class='login_button'>
                        <a href="{{route('account')}}" style="color:white;font-size:100%;float:left">Login/Register</a>
                    </div>
                @endif
               {{-- <div class="drop">
                    <div class="box">
                        <select tabindex="4" class="dropdown drop">
                            <option value="" class="label">Dollar :</option>
                            <option value="1">Dollar</option>
                            <option value="2">Euro</option>
                        </select>
                    </div>
                    <div class="box1">
                        <select tabindex="4" class="dropdown">
                            <option value="" class="label">English :</option>
                            <option value="1">English</option>
                            <option value="2">French</option>
                            <option value="3">German</option>
                        </select>
                    </div>
                    <div class="clearfix"></div>
                </div>--}}
            </div>
            <div class="col-md-6 top-header-left">
                <div class="cart box_1">
                    <a id='checkout_button' href="{{route('checkout')}}">
                        <div class="total">
                            <span class="basket_total"></span></div>
                        <img src="{{asset('images/cart-1.png')}}" alt="" />
                    </a>
                    <p><a href="javascript:;" style="color:white;font-size:80%" class="basket_empty">Empty Cart</a></p>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
@if(unserialize(request()->cookie('prof'))['avatar'])
<div id='dd' class="wrapper_profile">
    <!-----start-wrapper-dropdown-2---->
    <ul class="dropdown">
        {{--<li><a href="#"><i class="icon"></i>Message </a></li>--}}
        <li><a href="{{route('profile',['id'=> unserialize(request()->cookie('prof'))['id']])}}"><i class="icon stat"></i>My Profile</a></li>
        <li><a href="{{route('profile',['id'=> unserialize(request()->cookie('prof'))['id'],'edit'])}}"><i class="icon msg"></i>Edit Profile</a></li>
        <li><a href="{{route('logout')}}"><i class="icon signout"></i>Logout</a></li>
    </ul>
</div>
@endif








