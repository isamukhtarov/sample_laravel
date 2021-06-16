<p>Success login!!</p>
<a href="{{ route('user.logout') }}">Logout</a>
<p>
    {{ Sentinel::getUser()->email}}
</p>
