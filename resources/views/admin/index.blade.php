@extends('.admin/layouts/template')
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin_index')}}">Home</a> <i class="fa fa-angle-right"></i>Dashboard</li>
    </ol>
    <!--four-grids here-->
    <div class="four-grids">
        <div class="col-md-3 four-grid">
            <div class="four-agileits">
                <div class="icon">
                    <i class="glyphicon glyphicon-user" aria-hidden="true"></i>
                </div>
                <div class="four-text">
                    <h3>Users</h3>
                    <h4>{{$users}}</h4>
                </div>

            </div>
        </div>
        <div class="col-md-3 four-grid">
            <div class="four-agileinfo">
                <div class="icon">
                    <i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i>
                </div>
                <div class="four-text">
                    <h3>Orders</h3>
                    <h4>{{$orders}}</h4>
                </div>

            </div>
        </div>
        <div class="col-md-3 four-grid">
            <div class="four-w3ls">
                <div class="icon">
                    <i class="	glyphicon glyphicon-comment" aria-hidden="true"></i>
                </div>
                <div class="four-text">
                    <h3>Reviews</h3>
                    <h4>{{$reviews}}</h4>

                </div>

            </div>
        </div>
        <div class="col-md-3 four-grid">
            <div class="four-wthree">
                <div class="icon">
                    <i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i>
                </div>
                <div class="four-text">
                    <h3>Goods</h3>
                    <h4>{{$goods}}</h4>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!--//four-grids here-->

    <!--photoday-section-->


    <div class="col-sm-4 wthree-crd">
        <div class="card">
            <div class="card-body">
                <div class="widget widget-report-table">
                    <header class="widget-header m-b-15">
                    </header>

                    <div class="row m-0 md-bg-grey-100 p-l-20 p-r-20">
                        <div class="col-md-6 col-sm-6 col-xs-6 w3layouts-aug">
                            <h3>{{$now->format('F')}} {{$now->year}}</h3>
                            <p>REPORT</p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 ">
                            <h2 class="text-right c-teal f-300 m-t-20">${{$total_cost}}</h2>
                        </div>
                    </div>

                    <div  id="monthly_orders_div" class="widget-body p-15">
                        @include('admin/monthly_orders')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-4 w3-agileits-crd">

        <div class="card card-contact-list">
            <div class="agileinfo-cdr">
                <div class="card-header">
                    <h3>Contacts</h3>
                </div>
                <div class="card-body p-b-20">
                    <div class="list-group">
                        <a class="list-group-item media" href="{{route('single_user',['id'=>$admin->id])}}">
                            <div class="pull-left">
                                <img class="lg-item-img" src="{{asset('images/profile_ava/'.$admin->avatar)}}" alt="">
                            </div>
                            <div class="media-body">
                                <div class="pull-left">
                                    <div class="lg-item-heading">Alex</div>
                                    <small class="lg-item-text">whoiam942@gmail.com</small>
                                </div>
                                <div class="pull-right">
                                    <div class="lg-item-heading">Admin</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4 w3-agile-crd">
        <div class="card">
            <div class="card-body card-padding">
                <div class="widget">
                    <header class="widget-header">
                        <h4 class="widget-title">Activities</h4>
                    </header>
                    <hr class="widget-separator">
                    <div id="activities" class="widget-body">
                        @include('/admin/index_activities')
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <!--//photoday-section-->
    <!-- script-for sticky-nav -->

    <!-- /script-for sticky-nav -->
    <!--inner block start here-->
    <div class="inner-block">

    </div>
    <!--inner block end here-->
    <!--copy rights start here-->
    <!--COPY rights end here-->
    </div>
@endsection