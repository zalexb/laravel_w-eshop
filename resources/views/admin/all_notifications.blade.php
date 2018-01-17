@extends('.admin/layouts/template')
@section('content')
    <!--start-breadcrumbs-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="{{route('admin_index')}}">Home</a></li>
                    <li class="active">Notifications</li>
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->
    <!--prdt-starts-->

    <div class="prdt">
        <div class="container">
                <div class="col-md-9 prdt-left">
                    <ul style="" class="">
                        <?php
                        use Carbon\Carbon;
                        ?>
                        @foreach($notifications as $notification)
                            <li style="list-style-type: none;">
                                <div   class="notification_desc">
                                    <p style="font-size: 150%" class="{{$notification['users'][0]['checked']!=1 ? 'new_notifications' : ''}}" data-id="{{$notification['id']}}">{!! $notification['text'] !!}</p>
                                    <?php
                                    $created_at = Carbon::parse($notification['created_at']);
                                    ?>
                                    <p><span style="font-size: 130%">{{$created_at->diffForHumans()}}</span></p>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                        @endforeach
                        </li>
                                <div id="pagin">
                                    {{ $notifications->links('my_pagination')}}
                                </div>
                    </ul>
                </div>
        </div>
    </div>

@endsection