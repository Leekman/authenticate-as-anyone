@if(session()->has('aaa.origin-user'))
    <div>
        <p>
            Currently logged in as {{ session('aaa.user.firstname') }} {{ session('aaa.user.name') }}
            from Guard {{ session('aaa.user-guard') }}
        </p>
        <a href="{{ route('authenticate-as-anyone.log-back', ['userId' => session('cu')]) }}">Log back</a>
    </div>
@endif
