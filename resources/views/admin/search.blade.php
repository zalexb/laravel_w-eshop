@extends('.admin/layouts/template')
@section('content')
    <!--start-breadcrumbs-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="{{route('admin_index')}}">Home</a></li>
                    <li class="active">Search</li>
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->
    <!--prdt-starts-->

    <div class="prdt">
        <div class="container">
            <div class="col-md-9 prdt-left">
            @if(!$goods->isEmpty())
                        @foreach($goods as $good)
                            <div class="bootstrap-tab-text-grid favorite_single" data-id="{{$good->id}}">
                                <div class="bootstrap-tab-text-grid-left">
                                    <a  href="{{route('admin_single_good',['id'=>$good->id])}}">
                                        <img class="img-responsive" src="{{asset('images/goods/'.$good->image->link)}}">
                                    </a>
                                </div>
                                <div class="bootstrap-tab-text-grid-right">
                                    <ul style="padding: 0px;">
                                        <li >
                                            <a  href="{{route('admin_single_good',['id'=>$good->id])}}">
                                                <span class="name">{{$good->name}}</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <p style="overflow-x:hidden">
                                    <h3>Description:</h3>
                                    <span name="content" data-id="{{$good->id}}" class="single_value_fav">{{$good->description}}</span>
                                    </p>
                                </div>
                                <div class="clearfix"> </div>
                        @endforeach
                </div>
                @else

                @endif
                @if(!$users->isEmpty())
                                @foreach($users as $user)
                                    <div class="bootstrap-tab-text-grid review_single" data-id="{{$user->id}}">
                                        <div class="bootstrap-tab-text-grid-left">
                                            <img class="img-responsive zoom-img image_link" src="{{asset('images/profile_ava/'.$user->avatar)}}"/>
                                            <a href="{{route('single_user',['id'=>$user->id])}}" class="mask">
                                                <div class="product-bottom">
                                                    <h3 class="item_name">Id:{{$user->id}}</h3>
                                                    <h3 class="item_name">{{$user->first_name}} {{$user->last_name}}</h3>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="clearfix"> </div>

                                    </div>
                                @endforeach
                @else
                @endif
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{asset('js/jquery-ui.js')}}"></script>

    <!--sort sidebar ends-->
@endsection