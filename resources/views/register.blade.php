@extends('./layouts/template')
@section('content')
	<!--start-breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<div class="breadcrumbs-main">
				<ol class="breadcrumb">
					<li><a href="{{route('index')}}">Home</a></li>
					<li class="active">Register</li>
				</ol>
			</div>
		</div>
	</div>
	<!--end-breadcrumbs-->
	<!--register-starts-->
	<div class="register">
		<div class="container">
			<div class='information' id="modal_register">
				<span id="modal_close">X</span>
			</div>
			<div id="overlay"></div><!-- Пoдлoжкa -->

			<div class="register-top heading">
				<h2>REGISTER</h2>
			</div>

			<form id="register_form" action="javascript:;" method="POST">
				<div class="register-main">
					<div class="col-md-6 account-left">
						<input  name='first_name'placeholder="First name" type="text" tabindex="1">
						<input name='last_name' placeholder="Last name" type="text" tabindex="2">
						<input name='email' placeholder="Email address" type="text" tabindex="3" required>
						<input name='phone' placeholder="Phone (Example: 380934435798)" type="text" tabindex="3" required>
						{{--<ul>
							<li><label class="radio left"><input type="radio" name="Male" checked=""><i></i>Male</label></li>
							<li><label class="radio"><input type="radio" name="Famale"><i></i>Female</label></li>
							<div class="clearfix"></div>
						</ul>--}}
					</div>
					<div class="col-md-6 account-left">
						<input name='password' placeholder="Password" type="password" tabindex="4" required>
						<input name="confirm_password" placeholder="Retype password" type="password" tabindex="4" required>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="address">
								<input type="submit" value="Register">
				</div>
				{{csrf_field()}}
			</form>
		</div>
	</div>
	<script src="{{asset('js/validate.js')}}"></script>
	<!--register-end-->
@endsection