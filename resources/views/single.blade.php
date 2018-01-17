@extends('./layouts/template')
@section('content')
<!--dropdown-->
<script type="text/javascript">
	$(function() {
	
	    var menu_ul = $('.menu_drop > li > ul'),
	           menu_a  = $('.menu_drop > li > a');
	    
	    menu_ul.hide();
	
	    menu_a.click(function(e) {
	        e.preventDefault();
	        if(!$(this).hasClass('active')) {
	            menu_a.removeClass('active');
	            menu_ul.filter(':visible').slideUp('normal');
	            $(this).addClass('active').next().stop(true,true).slideDown('normal');
	        } else {
	            $(this).removeClass('active');
	            $(this).next().stop(true,true).slideUp('normal');
	        }
	    });
	
	});
</script>
	<!--start-breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<div class="breadcrumbs-main">
				<ol class="breadcrumb">
					<li><a href="{{route('index')}}">Home</a></li>
					<li class="active">Single</li>
				</ol>
			</div>
		</div>
	</div>
	<!--end-breadcrumbs-->
	<!--start-single-->
	<div class="single contact">
		<div class="container">
			<div class="single-main">
				<div class="col-md-9 single-main-left">
				<div class="sngl-top product-main">
					<div class="col-md-5 single-top-left">	
						<div class="flexslider">
							<ul class="slides">
								  @foreach($good[0]->images as $image)
								<li data-thumb="{{asset('images/goods/'.$image->link)}}">
									<div class="thumb-image"> <img src="{{asset('images/goods/'.$image->link)}}" data-imagezoom="true" class="img-responsive" alt="{{$image->alt}}"/> </div>
								</li>
									  @endforeach
							  </ul>
						</div>
						<!-- FlexSlider -->
						<script src="{{asset('js/imagezoom.js')}}"></script>
						<script defer src="{{asset('js/jquery.flexslider.js')}}"></script>
						<link rel="stylesheet" href="{{asset('css/flexslider.css')}}" type="text/css" media="screen" />

						<script>
						// Can also be used with $(document).ready()
						$(window).load(function() {
						  $('.flexslider').flexslider({
							animation: "slide",
							/*controlNav: "thumbnails"*/
						  });
						});
						</script>
					</div>
					<div class="col-md-7 single-top-right">

						<div class="single-para simpleCart_shelfItem">
						<h2 alias="{{$good[0]->alias}}" class="item_name">{{$good[0]->name}}</h2>
							 <div class="star-on">
								<ul class="star-footer">
									@for($i=5;$i>=1;$i--)
											@if(Cookie::get('prof')&&($good[0]->reviews->where('user_id','=',unserialize(request()->cookie('prof'))['id'])->isEmpty()||!$good[0]->reviews->where('user_id','=',unserialize(request()->cookie('prof'))['id'])->first()->rating))
												<a href="{{route('rating',['good_id'=>$good[0]->id,'rating'=>$i])}}" {{$good[0]->rating>=$i ? 'class=rated' : 'class=non-rated'}}  >
											@else
												<i {{$good[0]->rating>=$i ? 'class=rated' : 'class=non-rated'}}></i>
											@endif
											@if(Cookie::get('prof')&&($good[0]->reviews->where('user_id','=',unserialize(request()->cookie('prof'))['id'])->isEmpty()||!$good[0]->reviews->where('user_id','=',unserialize(request()->cookie('prof'))['id'])->first()->rating))
												</a>
											@endif
									@endfor
									</ul>
								<div class="review">
									<span>{{$good[0]->reviews->where('rating','!=',0)->count()}}  user{{$good[0]->reviews->where('rating','!=',0)->count()!=1 ? 's' : ''}} rated </span>
								</div>
								 <br>
								@if($good[0]->favorites_users()->get()->find(unserialize(request()->cookie('prof'))['id']))
									 <a href="{{route('favorite_delete',['good_id'=>$good[0]->id])}}">
										 <img style="padding-top: 5px;width: 50px" src="{{asset('images/favorite_delete.png')}}">
									 </a>
								@elseif(unserialize(request()->cookie('prof'))['id'])
									 <a href="{{route('favorite_add',['good_id'=>$good[0]->id])}}">
										 <img style="padding-top: 5px;width: 50px" src="{{asset('images/favorite_add.png')}}">
									 </a>
								@endif

							<div class="clearfix"> </div>
							</div>
							
							<h5>$<span class="item_price">{{$good[0]->price}}</span></h5>
							<p>{{$good[0]->description}}</p>
							{{--<ul class="tag-men">--}}
								{{--<li><span>TAG</span>--}}
								{{--<span class="women1">: {{$good[0]->categories[0]->name}}, {{$good[0]->brand}}</span></li>--}}
								{{--<li><span>MPN</span>--}}
								{{--<span class="women1">:{{$good[0]->MPN}}</span></li>--}}
							{{--</ul>--}}
								<a alias="{{$good[0]->alias}}" data-id="{{$good[0]->id}}" href="javascript:;" class="single_good item_add add-cart a_button{{$good[0]->id}}">ADD TO CART</a>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>

					<div class="responsive_tabs_agileits">
						<div id="horizontalTab">
							<ul class="resp-tabs-list">
								<li>Information</li>
								<li>Reviews</li>
							</ul>
							<div class="resp-tabs-container">
								<!--/tab_one-->
								<div class="tab1">
									<div class="single_page_agile_its_w3ls">
										<div style="padding:2em;">
										<ul>
											<li class="single_info">
												<span class="single_name">Brand: </span>
												<span class="single_value">{{$good[0]->brand}}</span>
											</li>
											<li class="single_info">
												<span class="single_name">Guarantee: </span>
												<span class="single_value">{{$good[0]->guarantee}}</span>
											</li>
											<li class="single_info">
												<span class="single_name">Case width approx: </span>
												<span class="single_value">{{$good[0]->case_width_approx_mm }}mm</span>
											</li>
											<li class="single_info">
												<span class="single_name">Case depth approx: </span>
												<span class="single_value">{{$good[0]->case_depth_approx_mm }}mm</span>
											</li>
											<li class="single_info">
												<span class="single_name">Categories: </span>
												<span class="single_value">
													@foreach($good[0]->categories as $category)
														{{$category->name }}
													@endforeach
												</span>
											</li>
											<li class="single_info">
												<span class="single_name">Color: </span>
												<span class="single_value">{{$good[0]->color}}</span>
											</li>
											<li class="single_info">
												<span class="single_name">Water resistancy: </span>
												<span class="single_value">{{$good[0]->water_resistancy_m}}m</span>
											</li>
											<li class="single_info">
												<span class="single_name">Stock: </span>
												<span class="single_value">{{$good[0]->stock!=null ? 'Yes' : 'No'}}</span>
											</li>
											<li class="single_info">
												<span class="single_name">MPN: </span>
												<span class="single_value">{{$good[0]->MPN}}</span>
											</li>
										</ul>
									</div>
									</div>
								</div>
								<!--//tab_one-->
								<div class="tab2">
									<div class="single_page_agile_its_w3ls">
										<div style="padding:2em;">
										<div class="bootstrap-tab-text-grids">
										@foreach($reviews as $review)
											<div class="bootstrap-tab-text-grid">
												<div class="bootstrap-tab-text-grid-left">
													<img style="width: 100px;" src="{{

												substr($review->user->avatar,0,4)!='http' ? asset('/images/profile_ava/'.($review->user->avatar)) : $review->user->avatar

													}}" alt=" " class="img-responsive">
												</div>
												<div class="bootstrap-tab-text-grid-right">
													<ul>
														<li><a href="{{route('profile',['id'=>$review->user->id])}}">{{$review->user->first_name}} {{$review->user->last_name}}</a></li>
													</ul>
													<p style="overflow-x:hidden">{{$review->content}}</p>
												</div>
												<div class="clearfix"> </div>
											</div>
										@endforeach
											<div>
												{{ $reviews->links('my_pagination') }}
											</div>

											@if(Cookie::get('prof')!=null)
											<div class="add-review">
												<h4>add a review</h4>
												<form id="review_form" action="javascript:;" method="post">
													{{--<input type="text" placeholder="First name" name="first_name" required {{Cookie::get('prof')!=null ? 'value='.(unserialize(request()->cookie('prof'))['first_name']) : '' }}>--}}
													{{--<input type="text" placeholder="Last name" name="last_name" required {{Cookie::get('prof')!=null ? 'value='.(unserialize(request()->cookie('prof'))['last_name']) : '' }}>--}}
													<textarea placeholder="Message" name="content" required></textarea>
													<input type="submit" value="SEND">
												</form>
											</div>
											@else
												<h3>Please login for leaving review</h3>
											@endif
										</div>
									</div>
									</div>
								</div>

							</div>
						</div>
					</div>

				<div class="latestproducts">
					<div class="product-one">
						@foreach($recs as $rec)
						<div class="col-md-4 product-left p-left"> 
							<div class="product-main simpleCart_shelfItem">
								<a href="{{route('single',['alias'=>$rec->alias])}}" class="mask"><img class="img-responsive zoom-img image_link" src="{{asset('images/goods/'.$rec->image->link)}}" alt="{{$rec->image->alt}}" /></a>
								<div class="product-bottom">
									<h3  class="item_name">{{$rec->name}}</h3>
									<p>Explore Now</p>
									<h4><a data-id="{{$rec->id}}"  alias="{{$rec->alias}}" class="item_add a_button{{$rec->id}}" href="javascript:;"><i class="button_buy icon{{$rec->id}}"></i></a><span>$<span class=" item_price">{{$rec->price}}</span></span></h4>
								</div>
								<div class="srch">
									<span>-{{$rec->discount_percent}}%</span>
								</div>
							</div>
						</div>
						@endforeach
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
<script type="text/javascript" src="{{asset('js/easy_responsive_tabs.js')}}"></script>
<script type="text/javascript" src="{{asset('js/review.js')}}"></script>
<span  style='display:none' class="image_link_single" src="{{asset('images/goods/'.$good[0]->image->link)}}">
<!--end-single-->
@endsection