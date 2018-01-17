@extends('./layouts/template')
@section('content')
	<!--banner-starts-->
	<div class="bnr" id="home">
		<div  id="top" class="callbacks_container">
			<ul class="rslides" id="slider4">
				@foreach($slider_imgs as $img)
			    <li>
					<img src="{{asset('images/'.$img->link)}}" alt=""/>
				</li>
				@endforeach
			</ul>
		</div>
		<div id="zalupa"></div>
		<div class="clearfix"> </div>
	</div>
	<!--banner-ends--> 
	<!--Slider-Starts-Here-->
	<script src="{{asset('js/responsiveslides.min.js')}}"></script>
			 <script>
			    // You can also use "$(window).load(function() {"
			    $(function () {
			      // Slideshow 4
			      $("#slider4").responsiveSlides({
			        auto: true,
			        pager: true,
			        nav: true,
			        speed: 500,
			        namespace: "callbacks",
			        before: function () {
			          $('.events').append("<li>before event fired.</li>");
			        },
			        after: function () {
			          $('.events').append("<li>after event fired.</li>");
			        }
			      });
			
			    });
			  </script>
			<!--End-slider-script-->
	<!--about-starts-->
	<div class="about"> 
		<div class="container">
			<div class="about-top grid-1">
				@foreach($main_goods as $good)
				<div class="col-md-4 about-left">
					<figure class="effect-bubba">
						<a href="{{route('single',['alias'=>$good->alias])}}">
						<img class="img-responsive" src="{{asset('images/goods/'.$good->images->where('id',$good->main_id_img)->first()->link)}}" alt="{{$good->images->where('id',$good->main_id_img)->first()->alt}}"/>
						<figcaption>
							<h2>{{$good->name}}</h2>
							<p>{{$good->description}}</p>
						</figcaption>
						</a>
					</figure>
				</div>
				@endforeach
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!--about-end-->
	<!--product-starts-->
	<div class="product"> 
		<div class="container">
			<div class="product-top">
                <?$i=1;?>
				@foreach($new_goods as $good)
					@if($i%4==0||$i==1)
						<div class="product-one">
							@endif
							<div class="col-md-3 product-left">
								<div class="product-main">
									<a href="{{route('single',['alias'=>$good->alias])}}" class="mask"><img class="image_link img-responsive zoom-img" src="{{asset('images/goods/'.$good->images->where('id',$good->main_id_img)->first()->link)}}" alt="{{$good->images->where('id',$good->main_id_img)->first()->alt}}" /></a>
									<div class="product-bottom">
										<h3  class="item_name">{{$good->name}}</h3>
										<p>Explore Now</p>
										<h4><a data-id="{{$good->id}}" alias="{{$good->alias}}" class="item_add a_button{{$good->id}}" href="javascript:;"><i class="button_buy icon{{$good->id}}"></i></a><span>$<span class="item_price">{{$good->price}}</span></span></h4>
									</div>
									@if($good->discount_percent)
									<div class="srch">
										<span>-{{$good->discount_percent}}%</span>
									</div>
									@endif
								</div>
							</div>
							@if($i%4==0)
								<div class="clearfix"></div>
						</div>
					@endif
                    <?$i+=1?>
				@endforeach
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!--product-end-->
	@endsection