@extends('.admin/layouts/template')
@section('content')
    <!--start-breadcrumbs-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="{{route('admin_index')}}">Home</a></li>
                    <li class="active">Create category</li>
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->
    <!--start-single-->

    <div class="single contact">
        <div class="container">
            @if (session('status')=='No access')
                <div class="alert alert-error">
                    <h1>Users have no access to create!</h1>
                </div>
            @elseif(session('status')=='success')
                <div  class="alert alert-error" style="color:green">
                    <h1>Category created!</h1>
                </div>
            @endif
            <form id="create_category">
                {{ csrf_field() }}
                <p class="create_good_input"><input placeholder="Name" name="name"></p>
                <p class="create_good_input"><input type="submit" value="Create" ></p>
            </form>
        </div>
    </div>
    <script src="{{asset('js/admin/create_category.js')}}"></script>


@endsection