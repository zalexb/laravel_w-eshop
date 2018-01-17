@extends('./admin/layouts/template')
@section('content')
    <!--start-breadcrumbs-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="{{route('admin_index')}}">Home</a></li>
                    <li class="active">Category</li>
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->
    <!--start-single-->


    <div class="single contact">
        <div class="container">
            <div class="single-main">
                <h3 >Id: <span class="item_id ">{{$category->id}}</span></h3>

                <h3 >Name: <span name="name" class="single_value">{{$category->name}}</span></h3>

                <form action="/admin/delete_category/{{$category->id}}" method="POST">
                    <button onclick="return confirm('Are you sure?')">Delete category</button>
                    {{csrf_field()}}
                </form>
                @if (session('status')=='No access')
                    <div class="alert alert-error">
                        <h1>Users have no access to edit!</h1>
                    </div>
                @elseif(session('status')=='goods')
                    <div class="alert alert-error">
                        <h1>Category must have no goods!</h1>
                    </div>
                @endif
                <div class="tab2">
                    <h1>Goods</h1>
                    <div class="single_page_agile_its_w3ls">
                        <div class="bootstrap-tab-text-grids">
                            <div id="favorite_single">
                                @include('./admin/category_goods')
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