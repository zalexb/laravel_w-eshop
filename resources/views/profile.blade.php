@extends('./layouts/template')
@section('content')
    <div class="">
        <div class="col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">
            <div class="well profile">

                <div class="col-sm-12">
                    <div class="col-xs-12 col-sm-8">
                        <h2>{{$user->first_name}} {{$user->last_name}}</h2>
                        @if(Request::is(unserialize(request()->cookie('prof'))['id'].'/*'))

                        {!! $user->email != false ? '<p><strong>Email: </strong>'. $user->email .'</p>' :'' !!}
                        {!! $user->phone != false ? '<p><strong>Phone: </strong>+'. $user->phone .'</p>' :'' !!}
                        {!! $user->last_login != false ? '<p><strong>Last login: </strong>'. $user->last_login .'</p>' :'' !!}

                        @endif

                    </div>
                    <div class="col-xs-12 col-sm-4 text-center">
                        <figure>
                            <img style="width: 300px" src="{{

                            substr($user->avatar,0,4)!='http' ? asset('/images/profile_ava/'.($user->avatar)) : $user->avatar

                            }}" alt="user" class="img-responsive">
                            <br>
                            @if(Request::is(unserialize(request()->cookie('prof'))['id'].'/*'))
                                <div class="form-group">
                                    <button style="max-width: 120px;" class="edit_image btn btn-info "><span class="fa fa-user"></span>Change image</button>
                                    <form action="javascript:;" style="display: none" id="edit_image" enctype="multipart/form-data">
                                        <div class="row setup-content" id="step-1">
                                            <div style="max-width: 300px">
                                                <div class="col-md-12 well text-center">
                                                    <label for="avatar">Select a File to Upload</label><br />
                                                    <input type="file" name="avatar" id="fileToUpload"/>
                                                </div>
                                                <div id="fileName"></div>
                                                <div id="fileSize"></div>
                                                <div id="fileType"></div>
                                                <div class="row">
                                                    <input type="submit"  value="Upload" />
                                                </div>
                                                <div id="progressNumber"></div>
                                            </div>
                                        </div>
                                        {{ csrf_field() }}
                                </form>
                                </div>
                            @endif
                        </figure>
                    </div>
                    @if(Request::is(unserialize(request()->cookie('prof'))['id'].'/*'))
                    <div  id="edit">
                        <button style="max-width: 100px;margin-bottom: 20px;" class="edit_button btn btn-info btn-block"><span class="fa fa-user"></span>Edit</button>
                        <form action="javascript:;" style="display: none" id="edit_form">
                            <div  class="col-md-6 account-left">
                                <input  name='first_name'placeholder="First name" type="text" tabindex="1">
                                <input  name='last_name'placeholder="Last name" type="text" tabindex="1">
                                <input  name='email'placeholder="Email" type="text" tabindex="1">
                                <input  name='phone'placeholder="Phone" type="text" tabindex="1">
                                <input name='password' placeholder="Password" type="password" tabindex="4">
                                <input name="confirm_password" placeholder="Retype password" type="password" tabindex="4" >
                                <div class="address">
                                    <input style="margin-bottom:10px " type="submit" value="Edit">
                                </div>
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
                <div class="col-xs-12 divider text-center">
                    <div class="col-xs-12 col-sm-4 emphasis">
                        <h2><strong>{{$user->reviews->where('content','!=',null)->count()}}</strong></h2>
                        <p><small></small></p>
                        <a href="{{route('reviews',['id'=>explode('/',$_SERVER['REQUEST_URI'])[1]])}}"><button class="btn btn-success btn-block"><span class="fa fa-plus-circle"></span>Reviews</button></a>
                    </div>
                    @if(Request::is(unserialize(request()->cookie('prof'))['id'].'/*'))
                        <div class="col-xs-12 col-sm-4 emphasis">
                            <h2><strong>{{$user->orders->count()}}</strong></h2>
                            <p><small></small></p>
                            <a href="{{route('orders',['id'=>unserialize(request()->cookie('prof'))['id']])}}"><button id="order_show" class="btn btn-info btn-block"><span class="fa fa-user"></span>Orders</button></a>
                        </div>
                    @endif
                    <div class="col-xs-12 col-sm-4 emphasis">
                        <h2><strong>{{$user->favorites_goods()->count()}}</strong></h2>
                        <p><small></small></p>
                        <div>
                            <a href="{{route('favorites',['user_id'=>explode('/',$_SERVER['REQUEST_URI'])[1]])}}"><button type="button" class="btn btn-info btn-block edit_profile_button"><span class="fa fa-gear"></span> Favorites</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="{{asset('js/profile.js')}}"></script>

@endsection