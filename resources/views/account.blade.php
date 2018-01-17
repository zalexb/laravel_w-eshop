@extends('./layouts/template')
@section('content')
	<!--start-breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<div class="breadcrumbs-main">
				<ol class="breadcrumb">
					<li><a href="{{route('index')}}">Home</a></li>
					<li class="active">Account</li>
				</ol>
			</div>
		</div>
	</div>
	<!--end-breadcrumbs-->
	<!--account-starts-->
	<div class="account">
		<div class="container">
		<div class="account-top heading">
				<h2>ACCOUNT</h2>
			@if (session('status')=='Activated')
				<h3 style="font-weight: bold;color: green">Thank you for activating your account! Now you can log in!</h3>
			@endif
			@if (session('status')=='Login')
					<h3 style="font-weight: bold;color: red">Please login for enter admin panel!</h3>
			@endif
			<div class="account-main">
				<div class="col-md-6 account-left">
					<h3>Existing User</h3>
					<form id='login_form' action="javascript:;" method="POST">
					<div class="account-bottom">
						<input name="email" placeholder="email" type="text" tabindex="3" required>
						<input name="password" placeholder="password" type="password" tabindex="4" required>
						<h2>or login with:</h2>
						<div class="infor-left">
							<ul>
								<li><a id="facebook_login" href="javascript:;"><span class="fb"></span><h6>Facebook</h6></a></li>
							</ul>
						</div>
						<div class="address">
							<a class="forgot" href="#">Forgot Your Password?</a>
							<input type="submit" value="Login">
						</div>
						{{csrf_field()}}
					</div>
					</form>
				</div>
				<div class="col-md-6 account-right account-left">
					<h3>New User? Create an Account</h3>
					<p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
					<a href="{{route('register')}}">Create an Account</a>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
		<script src="{{asset('js/jquery.loadingModal.min.js')}}"></script>
		<script src="{{asset('js/validate.js')}}"></script>
		<script src="{{asset('js/facebook.js')}}"></script>
	<!--account-end-->
@endsection
