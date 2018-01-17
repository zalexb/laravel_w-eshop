@extends('.admin/layouts/template')
@section('content')
    <!--start-breadcrumbs-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="{{route('admin_index')}}">Home</a></li>
                    <li class="active">Countries</li>
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->
    <!--prdt-starts-->
    <div class="prdt">
        <div class="container">
            <div id="roles">
                <div class="prdt-top">
                    <div class="col-md-9 prdt-left">
                        <div class="product-one">
                            @foreach($countries as $country)
                                <div class="col-md-4 product-left p-left">
                                    <div class="product-main">
                                        <div class="product-bottom">
                                            <a href="{{route('single_country',['id'=>$country->id])}}">
                                                <h3 class="item_name">Name:{{$country->name}}</h3>
                                                <p>Explore Now</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('js/jquery-ui.js')}}"></script>
    <!--sort sidebar ends-->
@endsection