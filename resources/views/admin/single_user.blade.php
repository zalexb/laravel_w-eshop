@extends('./admin/layouts/template')
@section('content')
    <!--start-breadcrumbs-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="{{route('admin_index')}}">Home</a></li>
                    <li class="active">User</li>
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->
    <!--start-single-->


    <div class="single contact">
        <div class="container">


            <h1 style="color:red;font-weight:bold"> For change value double click on it !</h1>
            <div class="single-main">
                <h3 >Id: <span class="item_id ">{{$user[0]->id}}</span></h3>

                <div class="col-md-9 single-main-left">
                    <div class="sngl-top ">
                        <div class="col-md-5 single-top-left">
                            <div class="images_div">
                                <h2 style="width: 700px">Avatar:</h2>
                                <div class="admin_single_images">
                                        <div style="width: 700px" class="images_div" data-id="{{$user[0]->id}}">
                                            <img style="height: 300px;width: 300px;position: relative;" src="{{asset('images/profile_ava/'.$user[0]->avatar)}}" data-imagezoom="true" class="img-responsive"/>
                                        </div>
                                    <div class="form-group">
                                        <br>
                                        <button style="max-width: 150px;" class="edit_image btn btn-info "><span class="fa"></span>Chane image</button>
                                        <form action="javascript:;" style="display: none" id="edit_image" enctype="multipart/form-data">
                                            <div  class="row setup-content" id="step-1">
                                                <div style="max-width: 300px">
                                                    <div class="col-md-12 well text-center">
                                                        <label for="avatar">Select a File to Upload</label><br />
                                                        <input type="file" name="avatar" id="fileToUpload"/>
                                                    </div>
                                                    <div id="fileName"></div>
                                                    <div id="fileSize"></div>
                                                    <div id="fileType"></div>
                                                    <div style="padding: 15px;" class="row">
                                                        <input type="submit"  value="Upload" />
                                                    </div>
                                                    <div id="progressNumber"></div>
                                                </div>
                                            </div>
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"> </div>

                <div class="">
                    <div id="horizontalTab">
                        <h2>Information</h2>
                        <div class="">
                            <!--/tab_one-->
                            <div class="">
                                <div class="single_page_agile_its_w3ls">
                                    <ul>
                                        <li class="single_info">
                                            <span class="single_name">First name: </span>
                                            <span name="first_name" class="single single_value">{{$user[0]->first_name}}</span>
                                        </li>
                                        <li class="single_info">
                                            <span class="single_name">Last name: </span>
                                            <span name="last_name" class="single single_value">{{$user[0]->last_name}}</span>
                                        </li>
                                        <li class="single_info">
                                            <span class="single_name">Email: </span>
                                            <span name="email" class="single single_value">{{$user[0]->email }}</span>
                                        </li>
                                        <li class="single_info">
                                            <span class="single_name">FB: </span>
                                            <span name="email" class="single single_value">{{$user[0]->facebook_id}}</span>
                                        </li>
                                        <li class="single_info">
                                            <span class="single_name">Phone: </span>
                                            <span name="phone" class="single single_value">{{$user[0]->phone }}</span>
                                        </li>
                                        <li class="single_info">
                                            <span class="single_name">Activated: </span>
                                            <span name="phone" class="single">
                                                @if(!$activation->isEmpty())
                                                    Yes
                                                @else
                                                    No
                                                @endif
                                            </span>
                                        </li>
                                        <li class=" single_info" style="padding-bottom: 20px">
                                            <p class="single_name">Roles: </p>
                                            <span class="user_role" >
                                                    <div id="roles_single">
													@foreach($user[0]->roles()->get() as $role)
                                                            <span style="padding: 7px; border: 1px solid black" class="single">{{$role->name }}<a data-id="{{$role->id}}" class=" role_delete" style="padding-left: 10px;color:black" href="javascript:;">x</a></span>
                                                        @endforeach
                                                    </div>
												</span>
                                            <div class="add_role" style="padding-top:20px"><button class=" role_button">Add role</button></div>
                                        </li>

                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="tab2">
                    <h1>Orders</h1>
                    <div class="single_page_agile_its_w3ls">
                        <div class="bootstrap-tab-text-grids">
                            <div id="order_single">
                                @include('./admin/order_single')
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab2">
                    <h1>Reviews</h1>
                    <div class="single_page_agile_its_w3ls">
                        <div class="bootstrap-tab-text-grids">
                            <div id="review_single">
                                @include('./admin/review_single')
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab2">
                    <h1>Favorites</h1>
                    <div class="single_page_agile_its_w3ls">
                        <div class="bootstrap-tab-text-grids">
                            <div id="favorite_single">
                                @include('./admin/favorite_single')
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    <script type="text/javascript" src="{{asset('js/easy_responsive_tabs.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/admin/user_single.js')}}"></script>
    <!--end-single-->
@endsection