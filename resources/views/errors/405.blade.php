
<!DOCTYPE HTML>
<html>
<head>
    <title>404 error page</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
    <link href="{{asset('css/404.css')}}" rel="stylesheet" type="text/css" media="all" />

</head>
<body>
<!-----start-wrap--------->
<div class="wrap">
    <!-----start-content--------->
    <div class="content">
        <!-----start-logo--------->
        <div class="logo">
            <h1><a href="{{route('index')}}"><img src="{{asset('images/404/logo.png')}}"/></a></h1>
            <span><img src="{{asset('images/404/signal.png')}}"/>Oops! The Page you requested was not found!</span>
        </div>
        <!-----end-logo--------->
        <!-----start-search-bar-section--------->
        <div class="buttom">
            <div class="seach_bar">
                <p>you can go to <span><a href="{{route('index')}}">home</a></span> page or search here</p>
                <!-----start-sear-box--------->
                <div class="search_box">
                    <form action="javascript:;" id="search_form">
                        <input id="search_input" type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
                        <input type="submit" value="">
                    </form>

                </div>
            </div>
        </div>
        <!-----end-sear-bar--------->
    </div>
    <!----copy-right-------------->
</div>
<script>
    $('#search_form').submit(function () {
        window.location.href = '/search/'+$('#search_input').val();
    });
</script>

</body>

</html>