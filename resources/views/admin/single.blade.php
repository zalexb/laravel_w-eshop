@extends('./admin/layouts/template')
@section('content')
    <!--start-breadcrumbs-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="{{route('admin_index')}}">Home</a></li>
                    <li class="active">Good</li>
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->
    <!--start-single-->


    <div class="single contact">
        <div class="container">


            <h1 style="color:red;font-weight:bold"> For change value double click on it !</h1>
            <div class="single-main">
                <h3 >Id: <span class="item_id ">{{$good[0]->id}}</span></h3>

                <h3 >Name: <span name="name" class="single_value">{{$good[0]->name}}</span></h3>

                <div class="col-md-9 single-main-left">
                    <div class="sngl-top ">
                        <div class="col-md-5 single-top-left">
                            <div class="images_div">
                                <h2 style="width: 700px">Images: <span style="padding-left: 250px">Main image:</span></h2>
                                <div class="admin_single_images">
                                    @foreach($good[0]->images as $image)
                                        <div style="width: 700px" class="images_div" data-id="{{$image->id}}">
                                            <img style="height: 300px;width: 300px;position: relative;" src="{{asset('images/goods/'.$image->link)}}" data-imagezoom="true" class="img-responsive" alt="{{$image->alt}}"/>
                                            <a class="image_delete" href="javascript:;" style="left:270px;top: -300px;;position:relative;z-index: 5;color:black;">
                                                <img src="{{asset('images/delete1.ico')}}" style="max-height: 30px;max-width: 30px" alt="">
                                            </a>
                                            <div style="width: 50px;left: 440px;top: -200px;position: relative;"><a href="javascript:;" style="padding-left: 10px" class="change_main_img"><img class="images_checkbox" data-id="{{$image->id}}" style="width: 30px;height: 30px" src="{{$good[0]->main_id_img==$image->id ? asset('images/checkbox_ok.ico') : asset('images/checkbox_empty.ico')}}" /></a></div>
                                        </div>
                                    @endforeach
                                        <div class="form-group">
                                            <button style="max-width: 150px;" class="edit_image btn btn-info "><span class="fa"></span>Add image</button>
                                            <form action="javascript:;" style="display: none" id="edit_image" enctype="multipart/form-data">
                                                <div  class="row setup-content" id="step-1">
                                                    <div style="max-width: 300px">
                                                        <div class="col-md-12 well text-center">
                                                            <label for="avatar">Select a File to Upload</label><br />
                                                            <input type="file" name="avatar" id="fileToUpload"/>
                                                        </div>
                                                        <div id="fileName"></div>
                                                        <div id="fileSize"></div>
                                                        <div id="fileType"></div>
                                                        <div style="padding: 15px;" class="row">
                                                            <input type="submit"  value="Upload" />
                                                        </div>
                                                        <div id="progressNumber"></div>
                                                    </div>
                                                </div>
                                                {{ csrf_field() }}
                                            </form>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                        <div class="col-md-7 single-top-right">

                            <div class="single-para simpleCart_shelfItem">



                                    <div class="clearfix"> </div>
                                </div>

                                <h3 >Price:  $<span name="price" class=" single_value">{{$good[0]->price}}</span></h3>
                            <p><h3>Description:</h3><span name="description" class=" single_value"> {{$good[0]->description}} </span></p>

                            </div>

                        <div class="clearfix"> </div>


                    <div class="">
                        <div id="horizontalTab">
                           <h2>Information</h2>
                            <div class="">
                                <!--/tab_one-->
                                <div class="">
                                    <div class="single_page_agile_its_w3ls">
                                        <ul>
                                            <li class="single_info">
                                                <span class="single_name">Brand: </span>
                                                <span name="brand" class="single single_value">{{$good[0]->brand}}</span>
                                            </li>
                                            <li class="single_info">
                                                <span class="single_name">Guarantee: </span>
                                                <span name="guarantee" class="single single_value">{{$good[0]->guarantee}}</span>
                                            </li>
                                            <li class="single_info">
                                                <span class="single_name">Case width approx: </span>
                                                <span name="case_width_approx_mm" class="single single_value">{{$good[0]->case_width_approx_mm }}</span>mm
                                            </li>
                                            <li class="single_info">
                                                <span class="single_name">Case depth approx: </span>
                                                <span name="case_depth_approx_mm" class="single single_value">{{$good[0]->case_depth_approx_mm }}</span>mm
                                            </li>
                                            <li class=" single_info" style="padding-bottom: 20px">
                                                <p class="single_name">Categories: </p>
                                                <span class="item_category" >
                                                    <div id="categories_single">
													@foreach($good[0]->categories as $category)
                                                        <span style="padding: 7px; border: 1px solid black" class="single">{{$category->name }}<a data-id="{{$category->id}}" class=" category_delete" style="padding-left: 10px;color:black" href="javascript:;">x</a></span>
                                                    @endforeach
                                                    </div>
												</span>
                                                <div class="add_category" style="padding-top:20px"><button class=" category_button">Add category</button></div>
                                            </li>
                                            <li class="single_info">
                                                <span class="single_name">Color: </span>
                                                <span name="color" class="single single_value">{{$good[0]->color}}</span>
                                            </li>
                                            <li class="single_info">
                                                <span class="single_name">Water resistancy: </span>
                                                <span  name="water_resistancy_m" class="single single_value">{{$good[0]->water_resistancy_m}}</span>m
                                            </li>
                                            <li class="single_info">
                                                <span class="single_name">Stock: </span>
                                                <span  class="single">
                                                    <select class="select_single" name="stock" >
                                                        <option value="1" {{$good[0]->stock!=null ? 'selected' : ''}}>Yes</option>
                                                        <option value="0" {{$good[0]->stock==null ? 'selected' : ''}}>No</option>
                                                    </select>
                                                </span>
                                            </li>
                                            <li class="single_info">
                                                <span class="single_name">MPN: </span>
                                                <span name="MPN" class="single single_value">{{$good[0]->MPN}}</span>
                                            </li>
                                            <li class="single_info">
                                                <span class="single_name">Case material: </span>
                                                <span name="case_material" class="single single_value">{{$good[0]->case_material}}</span>
                                            </li>
                                            <li class="single_info">
                                                <span class="single_name">Discount: </span>
                                                <span name="discount_percent" class="single single_value">{{$good[0]->discount_percent}}</span>
                                            </li>
                                            <li class="single_info">
                                                <span class="single_name">Public: </span>
                                                <span  class="single">
                                                    <select class="select_single" name="public" >
                                                        <option value="1" {{$good[0]->public!=null ? 'selected' : ''}}>Yes</option>
                                                        <option value="0" {{$good[0]->public==null ? 'selected' : ''}}>No</option>
                                                    </select>
                                                </span>
                                            </li>
                                            <li class="single_info">
                                                <span class="single_name">Alias: </span>
                                                <span name="alias" class="single">{{$good[0]->alias}}</span>
                                            </li>
                                            <li class="single_info">
                                                <span class="single_name">Rating: </span>
                                                <span name="rating" class="single">{{$good[0]->rating}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
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

                <div class="tab2">
                    <h1>Reviews</h1>
                    <div class="single_page_agile_its_w3ls">
                        <div class="bootstrap-tab-text-grids">
                            <div id="review_single">
                            @include('./admin/review_single')
                        </div>
                        </div>
                    </div>
                </div>


                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('js/easy_responsive_tabs.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/admin/items.js')}}"></script>
<!--end-single-->
@endsection