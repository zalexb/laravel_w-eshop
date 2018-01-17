<div class="streamline">
    <?php
    use Carbon\Carbon;
    ?>
    @foreach($notifications as $notification)
        <div class="sl-item sl-primary">
            <div class="sl-content">
                <?php
                $created_at = Carbon::parse($notification['created_at']);
                ?>
                <small class="text-muted">{{$created_at->diffForHumans()}}</small>
                <p>{!! $notification['text'] !!}</p>
            </div>
        </div>
    @endforeach
</div>
<div id="notifications_pagin">
    {{ $notifications->links('my_pagination')}}
</div>
<script src="{{asset('js/admin/index_activities.js')}}"></script>