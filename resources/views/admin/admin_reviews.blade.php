@extends('.admin/layouts/template')
@section('content')
    <!--start-breadcrumbs-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="{{route('admin_index')}}">Home</a></li>
                    <li class="active">Reviews</li>
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->
    <!--prdt-starts-->

    <div class="prdt">
        <div class="container">
            @if(!$reviews->isEmpty())
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
                    </select>
                </div>

            </div>
            <div id="orders">
                @include('.admin/reviews_catalog')
            </div>
            @else
                <h1>No reviews!</h1>
            @endif
        </div>
    </div>

    <script type="text/javascript" src="{{asset('js/jquery-ui.js')}}"></script>

    <!--sort sidebar ends-->
@endsection