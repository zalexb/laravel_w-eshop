@extends('.admin/layouts/template')
@section('content')
    <!--start-breadcrumbs-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="{{route('admin_index')}}">Home</a></li>
                    <li class="active">Create good</li>
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
            @endif
            <form action="/admin/create_good" method="post" enctype="multipart/form-data" id="create_good">
                <div class="row setup-content" id="step-1">
                    <p class="create_good_input">
                    <div style="max-width: 300px">
                        <div class="col-md-12 well text-center">
                            <label for="avatar">Select a File or multiple files to Upload</label><br />
                            <input type="file" name="images[]" id="fileToUpload" multiple/>
                        </div>
                        <div id="fileName"></div>
                        <div id="fileSize"></div>
                        <div id="fileType"></div>
                        <div id="progressNumber"></div>
                    </div>
                    </p>
                </div>

                {{ csrf_field() }}
                <p class="create_good_input"><input placeholder="Name" name="name"></p>
                <p class="create_good_input"><input placeholder="Price" type="number" name="price"></p>
                <p class="create_good_input"><textarea style="width: 500px;height: 200px" placeholder="Description" type="text" name="description"></textarea></p>
                <p class="create_good_input"><input placeholder="Brand" type="text" name="brand"></p>
                <p class="create_good_input"><input placeholder="Guarantee" type="text" name="guarantee"></p>
                <p class="create_good_input"><input placeholder="Case Depth Approx" type="number" name="case_depth_approx_mm"></p>
                <p class="create_good_input"><input placeholder="Case Width Approx" type="number" name="case_width_approx_mm"></p>
                <p class="create_good_input"><input placeholder="Color" type="text" name="color"></p>
                <p class="create_good_input"><input placeholder="Water Resistancy" type="number" name="water_resistancy_m"></p>
                <p class="create_good_input"><input placeholder="Case material" type="text" name="case_material"></p>
                <p class="create_good_input">
                    Stock:
                    <select name="stock">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </p>
                <p class="create_good_input"><input placeholder="MPN" type="text" name="MPN"></p>
                <p class="create_good_input">
                    Public:
                    <select name="public">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </p>
                <p class="create_good_input">
                    Category:
                    <select name="categories">
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </p>
                <p class="create_good_input"><input placeholder="Discount" type="number" name="discount_percent"></p>
                <p class="create_good_input"> <input type="submit" value="Create"></p>
            </form>
        </div>
    </div>
    <script src="{{asset('js/admin/create_good.js')}}"></script>


@endsection