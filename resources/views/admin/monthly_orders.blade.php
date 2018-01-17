<table class="table table-bordered">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Amount</th>
    </tr>
    </thead>
    <tbody>
    @foreach($month_report as $order)
        <tr>
            <td>
                <a href="{{route('admin_order',['id'=>$order->id])}}">{{$order->id}}</a>
            </td>
            <td>{{$order->first_name}} {{$order->last_name}}</td>
            <td>${{$order->order_cost}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div id="monthly_orders">
    {{ $month_report->links('my_pagination')}}
</div>
<script src="{{asset('js/admin/monthly_orders.js')}}"></script>