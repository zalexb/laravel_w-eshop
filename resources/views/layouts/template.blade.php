<!DOCTYPE html>
<html>
<head>
    <title>Luxury Watches</title>
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!--jQuery(necessary for Bootstrap's JavaScript plugins)-->
    <script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
    <!--Custom-Theme-files-->
    <!--theme-style-->
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
          rel = "stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!--//theme-style-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Luxury Watches " />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!--start-menu-->
    <script type="text/javascript" src="{{asset('js/basket.js')}}"></script>
    <link href="{{asset('css/memenu.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('css/jquery.loadingModal.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('css/easy_responsive_tabs.css')}}" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="{{asset('js/memenu.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/jquery.nicescroll.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/search.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/additional-methods.min.js')}}"></script>
    <script src="{{asset('js/jquery.loadingModal.min.js')}}"></script>
    <script>$(document).ready(function(){$(".memenu").memenu();});</script>
    <!--dropdown-->
    <script src="{{asset('js/jquery.easydropdown.js')}}"></script>
</head>
<body>
    @include('./layouts/top-header')
    <!--start-logo-->
    <div class="logo">
        <a href="{{route('index')}}"><h1>Luxury Watches</h1></a>
    </div>
    <!--start-logo-->
    <!--bottom-header-->
    <div class="header-bottom">
        <div class="container">
            <div class="header">
                <div class="col-md-9 header-left">
                    <div class="top-nav">
                        <ul class="memenu skyblue">
                            <li class="grid"><a href="{{route("index")}}">Home</a></li>
                            <li class="grid"><a href="{{route("products")}}">Catalog</a></li>
                            <li class="grid"><a href="{{route('admin_index')}}">Admin panel</a>
                            </li>
                            <li class="grid"><a href="{{route('contact')}}">Contact</a>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="col-md-3 header-right">
                    <div class="search-bar">
                        <form id="search_form" action="javascript:;">
                            <input id="search_input" type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
                            <input  type="submit" value="">
                        </form>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div id="search_modal">
            <span id="search_close">X</span>
            <table id="search_table">

            </table>
        </div>
    </div>
    <!--bottom-header-->

    <div id="content">
        @yield('content')
    </div>

    <!--information-starts-->
    <div class="information">
        <div class="container">
            <div class="infor-top">
                <div class="col-md-3 infor-left">
                    <h3>Follow Us</h3>
                    <ul>
                        <li><a href="#"><span class="fb"></span><h6>Facebook</h6></a></li>
                        <li><a href="#"><span class="twit"></span><h6>Twitter</h6></a></li>
                        <li><a href="#"><span class="google"></span><h6>Google+</h6></a></li>
                    </ul>
                </div>
                <div class="col-md-3 infor-left">
                    <h3>Information</h3>
                    <ul>
                        <li><a href="#"><p>Specials</p></a></li>
                        <li><a href="#"><p>New Products</p></a></li>
                        <li><a href="#"><p>Our Stores</p></a></li>
                        <li><a href="{{route('contact')}}"><p>Contact Us</p></a></li>
                        <li><a href="#"><p>Top Sellers</p></a></li>
                    </ul>
                </div>
                <div class="col-md-3 infor-left">
                    <h3>My Account</h3>
                    <ul>
                        <li><a href="{{route('account')}}"><p>My Account</p></a></li>
                        <li><a href="#"><p>My Credit slips</p></a></li>
                        <li><a href="#"><p>My Merchandise returns</p></a></li>
                        <li><a href="#"><p>My Personal info</p></a></li>
                        <li><a href="#"><p>My Addresses</p></a></li>
                    </ul>
                </div>
                <div class="col-md-3 infor-left">
                    <h3>Store Information</h3>
                    <h4>The company name,
                        <span>Lorem ipsum dolor,</span>
                        Glasglow Dr 40 Fe 72.</h4>
                    <h5>+955 123 4567</h5>
                    <p><a href="mailto:example@email.com">contact@example.com</a></p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!--information-end-->
    <!--footer-starts-->
    <div class="footer">
        <div class="container">
            <div class="footer-top">
                {{--<div class="col-md-6 footer-left">--}}
                    {{--<form>--}}
                        {{--<input type="text" value="Enter Your Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter Your Email';}">--}}
                        {{--<input type="submit" value="Subscribe">--}}
                    {{--</form>--}}
                {{--</div>--}}
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!--footer-end-->
</body>
</html>