@if (session()->has('status'))
    @if (session()->get('status')=='success')
            <div class="alert alert-success">{{session()->get('sms')}}</div>
        @elseif(session()->get('status')=='error')
            <div class="alert alert-danger">{{session()->get('sms')}}</div>
        @else
            <div class="alert alert-warning">{{session()->get('sms')}}</div>
    @endif
@endif