@extends('./admin/layouts/template')
@section('content')
    <!--start-breadcrumbs-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="{{route('admin_index')}}">Home</a></li>
                    <li class="active">Role</li>
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->
    <!--start-single-->


    <div class="single contact">
        <div class="container">
            <div class="single-main">
                <h3 >Id: <span class="item_id ">{{$role->id}}</span></h3>

                <h3 >Name: <span name="name" class="single_value">{{$role->name}}</span></h3>
                <h3 >Slug: <span name="name" class="single_value">{{$role->slug}}</span></h3>

                <form action="/admin/delete_role/{{$role->id}}" method="POST">
                    <button onclick="return confirm('Are you sure?')">Delete role</button>
                    {{csrf_field()}}
                </form>
                @if (session('status')=='No access')
                    <div class="alert alert-error">
                        <h1>Users have no access to edit!</h1>
                    </div>
                @elseif(session('status')=='users')
                    <div class="alert alert-error">
                        <h1>Role must have no users!</h1>
                    </div>
                @endif
                <div class="tab2">
                    <h1>Users</h1>
                    <div class="single_page_agile_its_w3ls">
                        <div class="bootstrap-tab-text-grids">
                            <div id="users">
                                @include('.admin/users_tab')
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