@extends('./admin/layouts/template')
@section('content')
    <!--start-breadcrumbs-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="{{route('admin_index')}}">Home</a></li>
                    <li class="active">Country</li>
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->
    <!--start-single-->


    <div class="single contact">
        <div class="container">

            <div class="single-main">
                <h3 >Id: <span class="item_id ">{{$country->id}}</span></h3>

                <h3 >Name: <span name="name" class="single_value">{{$country->name}}</span></h3>

                <form action="/admin/delete_country/{{$country->id}}" method="POST">
                    <button onclick="return confirm('Are you sure?')">Delete country</button>
                    {{csrf_field()}}
                </form>

                <p class="single_name">Cities: </p>
                <span class="cities" >
                    <div id="cities">
                    @foreach($country->cities as $city)
                            <p  style="max-width: 400px;padding: 7px; border-bottom: 1px solid black" class="single_city">
                                <a href="{{route('single_city',['id'=>$city->id])}}">
                                    {{$city->name}} (orders: {{$city->orders()->count()}}, active: {{$city->active==null ? 'No' :'Yes'}})
                                </a>
                        </p>
                    @endforeach
                    </div>
                </span>

                @if (session('status')=='No access')
                    <div class="alert alert-error">
                        <h1>Users have no access to edit!</h1>
                    </div>
                @elseif(session('status')=='city')
                    <div class="alert alert-error">
                        <h1>Country must have no cities!</h1>
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
    <!--end-single-->
@endsection