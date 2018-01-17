@extends('.admin/layouts/template')
@section('content')
    <!--start-breadcrumbs-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="{{route('admin_index')}}">Home</a></li>
                    <li class="active">Goods</li>
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->
    <!--prdt-starts-->
    <div class="prdt">
        <div class="container">

            <div class="col-md-9 prdt-left">
                <div id="paginate_by" style="text-align: right">
                    <label>Items per page:</label>
                    <br>
                    <select name="per_page" class="filters">
                        <option value="1">1</option>
                        <option value="9" selected="">9</option>
                        <option value="15">15</option>
                        <option value="21">21</option>
                    </select>
                </div>
                <div id="sort_by" style="margin-top: -56px;padding:10px">
                    <label for="sort">Sort by:</label>
                    <br>
                    <select name="sort_by" class="filters">
                        <option value="new_to_old">New to old</option>
                        <option value="old_to_new" selected="">Old to new</option>
                        <option value="rating">Rating</option>
                        <option value="popularity">Popularity</option>
                    </select>
                </div>

            </div>
            <div id="goods">
                @include('.admin/catalog')
            </div>
            <div id="cart_content">
                <!--product-end-->
                <!--sort sidebar-->
                @if(!empty($goods_paginated->all()))
                    <div class="col-md-3 prdt-right">
                        <div class="w_sidebar">
                            <section  class="sky-form">
                                <h4>Catogories</h4>
                                <div class="row1 scroll-pane">
                                    <div class="col col-4">
                                        @foreach($categories as $category)
                                            <label class="checkbox"><input type="checkbox" class="sort"  value="{{$category->name}}"  name="category" ><i></i>{{$category->name}} Watches</label>
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                            <section  class="sky-form">
                                <h4>Brand</h4>
                                <div class="row1 row2 scroll-pane">
                                    <div class="col col-4">
                                        @foreach($goods->groupBy('brand') as $good)
                                            <label class="checkbox"><input type="checkbox" class="sort" value="{{$good[0]->brand}}" name="brand" ><i></i>{{$good[0]->brand}}</label>
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                            <section  class="sky-form">
                                <h4>Color</h4>
                                <div class="row1 row2 scroll-pane">
                                    <div class="col col-4">
                                        @foreach($goods->groupBy('color') as $good)
                                            <label class="checkbox"><input type="checkbox" class="sort"  value="{{$good[0]->color}}"  name="color" ><i></i>{{$good[0]->color}}</label>
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                            <section  class="sky-form">
                                <h4>Price</h4>
                                <div class="row1 row2 scroll-pane">
                                    <p>
                                        <label for = "price">Price range:</label>
                                        <input type = "text" id = "price"
                                               style = "border:0; font-weight:bold;">
                                    </p>
                                    <div id = "price_slider"></div>
                                </div>
                            </section>
                            <div id = "price_slider"></div>
                            <section class="sky-form">
                                <h4>discount</h4>
                                <div class="row1 row2 scroll-pane">
                                    <div class="col col-4">
                                        <label class="radio"><input class="sort" type="radio" value="60" name="discount" ><i></i>60 % and above</label>
                                        <label class="radio"><input class="sort" type="radio" value="50"  name="discount"><i></i>50 % and above</label>
                                        <label class="radio"><input class="sort" type="radio" value="40"  name="discount"><i></i>40 % and above</label>
                                        <label class="radio"><input class="sort" type="radio" value="30"  name="discount"><i></i>30 % and above</label>
                                        <label class="radio"><input class="sort" type="radio" value="20"  name="discount"><i></i>20 % and above</label>
                                        <label class="radio"><input class="sort" type="radio" value="10"  name="discount"><i></i>10 % and above</label>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                @else
                    <h1>Nothing Found</h1>
                @endif
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('js/jquery-ui.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/sort.js')}}"></script>

    <!--sort sidebar ends-->
@endsection