@extends('./layouts/template')
@section('content')
	<!--start-breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<div class="breadcrumbs-main">
				<ol class="breadcrumb">
					<li><a href="{{route('index')}}">Home</a></li>
					<li class="active">Blog</li>
				</ol>
			</div>
		</div>
	</div>
	<!--end-breadcrumbs-->
	<!--blogs-starts-->
	<div class="pages" id="pages">
		<div class="container">
			<div class="typo-top heading">
				<h2>TYPOGRAPHY</h2>
			</div>
			<div class="typo-bottom">
			<div class="headdings">
				<h3 class="ghj">Headings</h3>
					<div class="bs-example">
						<table class="table">
						  <tbody>
							<tr>
							  <td><h1 class="head" id="h1.-bootstrap-heading">h1. Bootstrap heading<a class="anchorjs-link" href="#h1.-bootstrap-heading"><span class="anchorjs-icon"></span></a></h1></td>
							  <td class="type-info">Semibold 36px</td>
							</tr>
							<tr>
							  <td><h2 class="head" id="h2.-bootstrap-heading">h2. Bootstrap heading<a class="anchorjs-link" href="#h2.-bootstrap-heading"><span class="anchorjs-icon"></span></a></h2></td>
							  <td class="type-info">Semibold 30px</td>
							</tr>
							<tr>
							  <td><h3 class="head" id="h3.-bootstrap-heading">h3. Bootstrap heading<a class="anchorjs-link" href="#h3.-bootstrap-heading"><span class="anchorjs-icon"></span></a></h3></td>
							  <td class="type-info">Semibold 24px</td>
							</tr>
							<tr>
							  <td><h4 class="head" id="h4.-bootstrap-heading">h4. Bootstrap heading<a class="anchorjs-link" href="#h4.-bootstrap-heading"><span class="anchorjs-icon"></span></a></h4></td>
							  <td class="type-info">Semibold 18px</td>
							</tr>
							<tr>
							  <td><h5 class="head" id="h5.-bootstrap-heading">h5. Bootstrap heading<a class="anchorjs-link" href="#h5.-bootstrap-heading"><span class="anchorjs-icon"></span></a></h5></td>
							  <td class="type-info">Semibold 14px</td>
							</tr>
							<tr>
							  <td><h6 class="head">h6. Bootstrap heading</h6></td>
							  <td class="type-info">Semibold 12px</td>
							</tr>
						  </tbody>
						</table>
					</div>
			</div>
			<div class="Buttons">
				<h3 class="ghj">Buttons</h3>
				  <h1 class="b1">
					<a href="#"><span class="label label-default">Default</span></a>
					<a href="#"><span class="label label-primary">Primary</span></a>
					<a href="#"><span class="label label-success">Success</span></a>
					<a href="#"><span class="label label-info">Info</span></a>
					<a href="#"><span class="label label-warning">Warning</span></a>
					<a href="#"><span class="label label-danger">Danger</span></a>
				  </h1>
				  <h2 class="b2">
					<a href="#"><span class="label label-default">Default</span></a>
					<a href="#"><span class="label label-primary">Primary</span></a>
					<a href="#"><span class="label label-success">Success</span></a>
					<a href="#"><span class="label label-info">Info</span></a>
					<a href="#"><span class="label label-warning">Warning</span></a>
					<a href="#"><span class="label label-danger">Danger</span></a>
				  </h2>
				  <h3 class="b3">
					<a href="#"><span class="label label-default">Default</span></a>
					<a href="#"><span class="label label-primary">Primary</span></a>
					<a href="#"><span class="label label-success">Success</span></a>
					<a href="#"><span class="label label-info">Info</span></a>
					<a href="#"><span class="label label-warning">Warning</span></a>
					<a href="#"><span class="label label-danger">Danger</span></a>
				  </h3>
				  <h4 class="b4">
					<a href="#"><span class="label label-default">Default</span></a>
					<a href="#"><span class="label label-primary">Primary</span></a>
					<a href="#"><span class="label label-success">Success</span></a>
					<a href="#"><span class="label label-info">Info</span></a>
					<a href="#"><span class="label label-warning">Warning</span></a>
					<a href="#"><span class="label label-danger">Danger</span></a>
				  </h4>
				  <h5 class="b5">
					<a href="#"><span class="label label-default">Default</span></a>
					<a href="#"><span class="label label-primary">Primary</span></a>
					<a href="#"><span class="label label-success">Success</span></a>
					<a href="#"><span class="label label-info">Info</span></a>
					<a href="#"><span class="label label-warning">Warning</span></a>
					<a href="#"><span class="label label-danger">Danger</span></a>
				  </h5>
				  <h6 class="b6">
					<a href="#"><span class="label label-default">Default</span></a>
					<a href="#"><span class="label label-primary">Primary</span></a>
					<a href="#"><span class="label label-success">Success</span></a>
					<a href="#"><span class="label label-info">Info</span></a>
					<a href="#"><span class="label label-warning">Warning</span></a>
					<a href="#"><span class="label label-danger">Danger</span></a>
				  </h6>
		    </div>
		    <div class="progress-bars">
			 <h3 class="ghj">Progress Bars</h3>
				 <div class="tab-content">
					  <div class="tab-pane active" id="domprogress">
						  <div class="progress">    
							<div class="progress-bar progress-bar-primary" style="width: 20%"></div>
						  </div>
						  <p>Info with <code>progress-bar-info</code> class.</p>
						  <div class="progress">    
							<div class="progress-bar progress-bar-info" style="width: 60%"></div>
						  </div>
						  <p>Success with <code>progress-bar-success</code> class.</p>
						  <div class="progress">
							<div class="progress-bar progress-bar-success" style="width: 30%"></div>
						  </div>
						  <p>Warning with <code>progress-bar-warning</code> class.</p>
						  <div class="progress">
							<div class="progress-bar progress-bar-warning" style="width: 70%"></div>
						  </div>
						  <p>Danger with <code>progress-bar-danger</code> class.</p>
						  <div class="progress">
							<div class="progress-bar progress-bar-danger" style="width: 50%"></div>
						  </div>
						  <p>Inverse with <code>progress-bar-inverse</code> class.</p>
						  <div class="progress">
							<div class="progress-bar progress-bar-inverse" style="width: 40%"></div>
						  </div>
						   <p>Inverse with <code>progress-bar-inverse</code> class.</p>
						  <div class="progress">
							<div class="progress-bar progress-bar-success" style="width: 35%"><span class="sr-only">35% Complete (success)</span></div>
							<div class="progress-bar progress-bar-warning" style="width: 20%"><span class="sr-only">20% Complete (warning)</span></div>
							<div class="progress-bar progress-bar-danger" style="width: 10%"><span class="sr-only">10% Complete (danger)</span></div>
						  </div>
					</div>
			   </div>
		    </div>
			<div class="bread-crumbs">
				 <h3 class="ghj">Breadcrumbs</h3>
				   <ol class="breadcrumb">
				  <li class="active">Home</li>
				</ol>
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Library</li>
				</ol>
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li><a href="#">Library</a></li>
				  <li class="active">Data</li>
				</ol>
		    </div>
			<div class="pagenatin">
				<h3 class="ghj">Pagination</h3>
					<div class="col-md-6">
					  <nav>
					  <ul class="pagination pagination-lg">
						<li><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
						<li><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
					  </ul>
					  </nav>
					  <nav>
					  <ul class="pagination">
						<li><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
						<li><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
					  </ul>
					  </nav>
					  <nav>
						<ul class="pagination pagination-sm">
							<li><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
						</ul>
					  </nav>
					</div>
					<div class="col-md-6">
						<nav>
							<ul class="pagination pagination-lg">
									<li class="disabled"><a href="#"><i class="fa fa-angle-left">«</i></a></li>
									<li class="active"><a href="#">1</a></li>
									<li><a href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li><a href="#">4</a></li>
									<li><a href="#">5</a></li>
									<li><a href="#"><i class="fa fa-angle-right">»</i></a></li>
							</ul>
						</nav>
						<nav>
						  <ul class="pagination">
							<li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
							<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
						 </ul>
					    </nav>
					    <nav>
							 <ul class="pagination pagination-sm">
								<li class="disabled"><a href="#"><i class="fa fa-angle-left"></i>«</a></li>
								<li class="active"><a href="#">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#">5</a></li>
								<li><a href="#"><i class="fa fa-angle-right"></i>»</a></li>
							</ul>
						</nav>
					</div>
					<div class="clearfix"> </div>
			</div>
			<div class="alerts">
			  <h3 class="ghj">Alerts</h3>
			   <div class="alert alert-success" role="alert">
					<strong>Well done!</strong> You successfully read this important alert message.
			   </div>
			   <div class="alert alert-info" role="alert">
					<strong>Heads up!</strong> This alert needs your attention, but it's not super important.
			   </div>
			   <div class="alert alert-warning" role="alert">
					<strong>Warning!</strong> Best check yo self, you're not looking too good.
			   </div>
			   <div class="alert alert-danger" role="alert">
					<strong>Oh snap!</strong> Change a few things up and try submitting again.
			   </div>
		    </div>
			<div class="distracted">
			  <h3 class="ghj">Wells</h3>
				   <div class="well">
					There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
				   </div>
				   <div class="well">
					It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here
				   </div>
				   <div class="well">
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic
				   </div>
		    </div>
		<div class="appearance">
			 <h3 class="ghj">Badges</h3>
				<div class="col-md-6">
					<p>Add modifier classes to change the appearance of a badge.</p>
					  <table class="table table-bordered">
						<thead>
							<tr>
								<th>Classes</th>
								<th>Badges</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>No modifiers</td>
								<td><span class="badge">42</span></td>
							</tr>
							<tr>
								<td><code>.badge-primary</code></td>
								<td><span class="badge badge-primary">1</span></td>
							</tr>
							<tr>
								<td><code>.badge-success</code></td>
								<td><span class="badge badge-success">22</span></td>
							</tr>
							<tr>
								<td><code>.badge-info</code></td>
								<td><span class="badge badge-info">30</span></td>
							</tr>
							<tr>
								<td><code>.badge-warning</code></td>
								<td><span class="badge badge-warning">412</span></td>
							</tr>
							<tr>
								<td><code>.badge-danger</code></td>
								<td><span class="badge badge-danger">999</span></td>
							</tr>
						</tbody>
					</table>                    
				</div>
				<div class="col-md-6">
				  <p>Easily highlight new or unread items with the <code>.badge</code> class</p>
					<div class="list-group list-group-alternate"> 
						<a href="#" class="list-group-item"><span class="badge">201</span> <i class="ti ti-email"></i> Inbox </a> 
						<a href="#" class="list-group-item"><span class="badge badge-primary">5021</span> <i class="ti ti-eye"></i> Profile visits </a> 
						<a href="#" class="list-group-item"><span class="badge">14</span> <i class="ti ti-headphone-alt"></i> Call </a> 
						<a href="#" class="list-group-item"><span class="badge">20</span> <i class="ti ti-comments"></i> Messages </a> 
						<a href="#" class="list-group-item"><span class="badge badge-warning">14</span> <i class="ti ti-bookmark"></i> Bookmarks </a> 
						<a href="#" class="list-group-item"><span class="badge badge-danger">30</span> <i class="ti ti-bell"></i> Notifications </a> 
					</div>
			    </div>
			   <div class="clearfix"> </div>
			</div>
			</div>
		</div>	
	</div>	
	<!--blog-ends-->
	@endsection
