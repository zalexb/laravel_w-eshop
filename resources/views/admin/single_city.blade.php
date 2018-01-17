@extends('./admin/layouts/template')
@section('content')
    <!--start-breadcrumbs-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="{{route('admin_index')}}">Home</a></li>
                    <li class="active">City</li>
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->
    <!--start-single-->


    <div class="single contact">
        <div class="container">

            <div class="single-main">
                <h3 >Id: <span class="item_id ">{{$city->id}}</span></h3>

                <h3 >Name: <span name="name" class="single_value">{{$city->name}}</span></h3>

                <h3 >Active:
                    <select name="active">
                        <option value="0" {{$city->active!=null ? '' :'selected'}}>No</option>
                        <option value="1" {{$city->active==null ? '' :'selected'}}>Yes</option>
                    </select>
                </h3>
                <div class="single-error">
                </div>

                <h3 >Country: <a href="{{route('single_country',['id'=>$city->country->id])}}" name="name" class="single_value">{{$city->country->name}}</a></h3>

                <form action="/admin/delete_city/{{$city->id}}" method="POST">
                    <button onclick="return confirm('Are you sure?')">Delete city</button>
                    {{csrf_field()}}
                </form>

                @if (session('status')=='No access')
                    <div class="alert alert-error">
                        <h1>Users have no access to edit!</h1>
                    </div>
                @elseif(session('status')=='orders')
                    <div class="alert alert-error">
                        <h1>City must have no orders!</h1>
                    </div>
                @endif
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
            </div>
        </div>
    </div>
    </div>
    <script type="text/javascript" src="{{asset('js/easy_responsive_tabs.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/admin/single_city.js')}}"></script>
    <!--end-single-->
@endsection