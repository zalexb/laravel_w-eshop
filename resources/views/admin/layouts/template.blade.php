<!DOCTYPE>
<html style="overflow:auto;">
<head>
    <title>Admin-panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    {{--<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>--}}
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('css/admin/bootstrap.min.css')}}" rel='stylesheet' type='text/css' />

    <!-- Custom CSS -->
    <link href="{{asset('css/easy_responsive_tabs.css')}}" rel="stylesheet" type="text/css" media="all" />

    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
          rel = "stylesheet">
    <link href="{{asset('css/admin/style.css')}}" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="{{asset('css/admin/morris.css')}}" type="text/css"/>
    <link href="{{asset('css/jquery.loadingModal.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!-- Graph CSS -->
    <link href="{{asset('css/admin/font-awesome.css')}}" rel="stylesheet">
    <!-- jQuery -->
    <script src="{{asset('js/admin/jquery-2.1.4.min.js')}}"></script>
    <script src="{{asset('js/jquery.loadingModal.min.js')}}"></script>
    {{--notifications--}}
    <script src="{{asset('js/admin/notifications.js')}}"></script>
    <!-- //jQuery -->
    <link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
    <link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="{{asset('js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/additional-methods.min.js')}}"></script>

    <!-- lined-icons -->
    <link rel="stylesheet" href="{{asset('css/admin/icon-font.min.css')}}" type='text/css' />
    <!-- //lined-icons -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="page-container">
    <!--/content-inner-->
    <div class="left-content">
        <div class="mother-grid-inner">
            <!--header start here-->
            <div class="header-main">
                <div class="logo-w3-agile">
                    <h1><a href="{{route('admin_index')}}">Welcome</a></h1>
                </div>
                <div class="w3layouts-left">

                    <!--search-box-->
                    <div class="w3-search-box">

                        <form id="search_form" action="javascript:;" onsubmit="$(location).attr('href', '/admin/search/'+$('#search').val())" method="get">
                            <input id="search" type="text" placeholder="Search..." required="">
                            <input type="submit" value="">
                        </form>
                        <script>

                        </script>
                    </div><!--//end-search-box-->
                    <div class="clearfix"> </div>
                </div>
                <div class="w3layouts-right">
                    <div class="profile_details_left"><!--notifications of menu start -->
                        <ul class="nofitications-dropdown">
                            <li class="dropdown head-dpdn">
                                <a  id="mails_drop" href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope"></i>
                                    <span style="display: {{unserialize(request()->cookie('prof'))['new_mails']==0 ? 'none' : 'block'}}" class="new_mails_num badge">{{unserialize(request()->cookie('prof'))['new_mails']}}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="notification_header ">
                                            <h3 class="header_messages">You have {{unserialize(request()->cookie('prof'))['new_mails']}} new messages</h3>
                                        </div>
                                    </li>
                                    <div id="ul_mail">

                                    </div>
                                </ul>
                            </li>

                            <li class="dropdown head-dpdn">
                                <a href="javascript:;" class="dropdown-toggle notification_drop" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    <span style="display: {{unserialize(request()->cookie('prof'))['new_notifs_num']==0 ? 'none' : 'block'}}" class="new_notifications_num badge blue">
                                        {{unserialize(request()->cookie('prof'))['new_notifs_num']}}
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="notification_header">
                                            <h3 class="header_notifications">You have {{unserialize(request()->cookie('prof'))['new_notifs_num']}} new notification</h3>
                                        </div>
                                    </li>
                                    <?php
                                        use Carbon\Carbon;
                                        $not = unserialize(request()->cookie('prof'))['notifications'];
                                        $i = 0;
                                    ?>
                                    @foreach($not as $notification)
                                    <li>
                                            <div  class="notification_desc">
                                                <p class="{{$notification['users'][0]['checked']!=1 ? 'new_notifications' : ''}}" data-id="{{$notification['id']}}">{!! $notification['text'] !!}</p>
                                                <?php
                                                    $created_at = Carbon::parse($notification['created_at']);
                                                ?>
                                                <p><span>{{$created_at->diffForHumans()}}</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                    </li>
                                        <?php
                                            $i++;
                                        ?>
                                        @if ($i==3)
                                            @break;
                                        @endif
                                    @endforeach
                                    <div class="notification_bottom">
                                        @if ($i>=3)
                                            <a href="{{route('all_notifications')}}">See all notifications</a>
                                        @endif
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <div class="clearfix"> </div>
                        </ul>
                        <div class="clearfix"> </div>
                    </div>
                    <!--notification menu end -->

                    <div class="clearfix"> </div>
                </div>
                <div class="profile_details w3l">
                    <ul>
                        <li class="dropdown profile_details_drop">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <div class="profile_img">
                                    <span class="prfil-img">
                                        <img class="header_avatar" src="{{

                            substr(unserialize(request()->cookie('prof'))['avatar'],0,4)!='http' ? asset('/images/profile_ava/'.(unserialize(request()->cookie('prof'))['avatar'])) : unserialize(request()->cookie('prof'))['avatar']

                            }}" alt="">
                                    </span>
                                    <div class="user-name">
                                        <p>{{unserialize(request()->cookie('prof'))['first_name']}}</p>
                                        <p>{{unserialize(request()->cookie('prof'))['last_name']}}</p>
                                    </div>
                                    <i class="fa fa-angle-down"></i>
                                    <i class="fa fa-angle-up"></i>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                            <ul class="dropdown-menu drp-mnu">
                                <li> <a href="{{route('single_user',['id'=>unserialize(request()->cookie('prof'))['id']])}}"><i class="fa fa-user"></i> Profile</a> </li>
                                <li> <a href="{{route('logout')}}"><i class="fa fa-sign-out"></i> Logout</a> </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="clearfix"> </div>
            </div>
            <!--heder end here-->
            <div id="content">
                    @yield('content')

            </div>
    </div>
    <!--//content-inner-->
    <!--/sidebar-menu-->
    <div class="sidebar-menu">
        <header class="logo1">
            <a href="javascript:;" class="sidebar-icon"> <span class="fa fa-bars"></span> </a>
        </header>
        <div style="border-top:1px ridge rgba(255, 255, 255, 0.15)"></div>
        <div class="menu">
            <ul id="menu" >
                <li><a href="{{route('admin_index')}}"><i class="fa fa-tachometer"></i> <span>Dashboard</span><div class="clearfix"></div></a></li>


                <li id="menu-academico" ><a href="javascript:;"><i class="fa fa-list-ul" aria-hidden="true"></i><span>Goods</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                    <ul id="menu-academico-sub" >
                        <li id="menu-academico-avaliacoes" ><a href="{{route('create_good')}}">Add good</a></li>
                        <li id="menu-academico-avaliacoes" ><a href="{{route('admin_goods')}}">Goods list</a></li>
                    </ul>
                </li>

                <li id="menu-academico" ><a href="{{route('admin_users')}}"><i class="	fa fa-group"></i><span>Users</span><div class="clearfix"></div></a></li>

                <li id="menu-academico" ><a href="{{route('admin_orders')}}"><i class="	fa fa-newspaper-o"></i><span>Orders</span><div class="clearfix"></div></a></li>

                <li id="menu-academico" ><a href="{{route('admin_reviews')}}"><i class="	fa fa-comment-o"></i><span>Reviews</span><div class="clearfix"></div></a></li>

                <li id="menu-academico" ><a href="javascript:;"><i class="fa fa-list-ul" aria-hidden="true"></i><span>Roles</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                    <ul id="menu-academico-sub" >
                        <li id="menu-academico-avaliacoes" ><a href="{{route('add_role')}}">Add role</a></li>
                        <li id="menu-academico-avaliacoes" ><a href="{{route('roles_list')}}">Roles list</a></li>
                    </ul>
                </li>

                <li id="menu-academico" ><a href="javascipt:;"><i class="fa fa-list-ul" aria-hidden="true"></i><span>Categories</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                    <ul id="menu-academico-sub" >
                        <li id="menu-academico-avaliacoes" ><a href="{{route('create_category')}}">Add category</a></li>
                        <li id="menu-academico-avaliacoes" ><a href="{{route('categories_list')}}">Categories list</a></li>
                    </ul>
                </li>

                <li id="menu-academico" ><a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i><span>Countries&Cities</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                    <ul id="menu-academico-sub" >
                        <li id="menu-academico-avaliacoes" ><a href="{{route('add_country')}}">Add country</a></li>
                        <li id="menu-academico-avaliacoes" ><a href="{{route('add_city')}}">Add city</a></li>
                        <li id="menu-academico-avaliacoes" ><a href="{{route('country_list')}}">Countries list</a></li>
                    </ul>
                </li>

                <li id="menu-academico" ><a href="{{route('index')}}"><i class="glyphicon glyphicon-backward"></i><span>Back to site</span><div class="clearfix"></div></a></li>

            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
</div>

<!--js -->
<script src="{{asset('js/admin/jquery.nicescroll.js')}}"></script>
<script src="{{asset('js/admin/scripts.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{asset('js/admin/bootstrap.min.js')}}"></script>
<!-- /Bootstrap Core JavaScript -->
<!-- morris JavaScript -->
<script src="{{asset('js/admin/raphael-min.js')}}"></script>
<script src="{{asset('js/admin/morris.js')}}"></script>
{{----}}
<script src="{{asset('js/admin/mails.js')}}"></script>
</body>
</html>