@extends('./layouts/template')
@section('content')
	<script src="{{asset('js/order.js')}}"></script>
<!--start-breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<div class="breadcrumbs-main">
				<ol class="breadcrumb">
					<li><a href="{{route('index')}}">Home</a></li>
					<li class="active">Checkout</li>
				</ol>
			</div>
		</div>
	</div>
	<!--end-breadcrumbs-->
	<!--start-ckeckout-->
	<div class="ckeckout">
		<div class="container checkout">
			<div class="ckeck-top heading">
					<h2>CHECKOUT</h2>
			</div>
			<div class="ckeckout-top">
				<div class="cart-items">
				</div>
			 </div>
		</div>
		<div id="modal_order">
			<span id="modal_close">X</span>
			<form id="order_form" action="javascript:;" method="POST">
				<p>First name<p/>
				<input name="first_name" type="text" {{Cookie::get('prof')!=null ? 'value='.(unserialize(request()->cookie('prof'))['first_name']) : '' }}  >
				<p>Last name<p/>
				<input name="last_name" type="text" {{Cookie::get('prof')!=null ? 'value='.(unserialize(request()->cookie('prof'))['last_name']) : '' }}>
				<p>Select country
					<select name="country_id">

					</select>
				</p>
				<p id='city_select' style="display: none" >Select city
					<select name="city_id">
						<option value=""></option>
					</select>
				</p>
				<p>Delivery type
					<select name="delivery_type">
						<option></option>
						<option value="1">Express</option>
						<option value="2">Self pick-up</option>
					</select>
				</p>
				<p>Full address(street, apartment number) <p/>
				<input name="address" type="text">
				<p>Postal/Zip code<p/>
				<input name="postal_zip" type="text" >
				<p>Phone (Example: 380934435798) </p>
				+<input name="phone" type="text" {{Cookie::get('prof')!=null ? 'value='.(unserialize(request()->cookie('prof'))['phone']) : '' }}>
				<br>
				<br>
				<input type="submit" value="Buy">
			</form>
		</div>
		<div id="overlay"></div>

	</div>

	<!--end-ckeckout-->
	@endsection