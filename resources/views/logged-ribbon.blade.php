@if(session()->has('aaa.origin-user'))
    <div>
        <p>
            Currently logged in as {{ session('aaa.user')->aaafirstname }} {{ session('aaa.user')->aaaName }}
            from Model {{ get_class(session('aaa.user')) }}
        </p>
        <a href="{{ route('authenticate-as-anyone.auth', ['model' => get_class(session('aaa.origin-user')), 'userId' => session('aaa.origin-user')->getAuthIdentifier()]) }}">
            Log back
        </a>
    </div>
@endif
