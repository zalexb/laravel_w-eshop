@extends('.admin/layouts/template')
@section('content')
    <!--heder end here-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin_index')}}">Home</a><i class="fa fa-angle-right"></i>Inbox</li>
    </ol>
    <div class="inbox-mail">
        <!-- tab content -->
        <div class="col-md-8 tab-content tab-content-in w3">
            <div class="tab-pane text-style active" id="tab1">
                <div class="inbox-right">
                        <table class="table">
                            <tbody>
                            @foreach($mails as $mail)
                            <tr class="table-row">
                                <td class="table-text">
                                    <h6>Name: {{$mail->name}}</h6>
                                    <h6>Email: {{$mail->email}}</h6>
                                    <h6>Phone: {{$mail->phone}}</h6>
                                    <p>{{$mail->message}}</p>
                                </td>
                                <td class="march">
                                    {{$mail->diff_in_time}}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        <div class="clearfix"> </div>
    </div>

@endsection