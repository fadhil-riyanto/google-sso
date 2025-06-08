<h1>you need login, click <a href="/auth/redirect">login with google</a> please</h1>

@if ($errors->any())
<ul>
        @foreach ($errors->all() as $message)
        <li>{{ $message }}</li>
        @endforeach
</ul>
@endif