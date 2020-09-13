@extends('layout')
@section('content')
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item active">
            <a class="nav-link" href="#">Tasks</a>
        </li>
        <li class="nav-item">
            <a class="nav-link logout-link" href="#">Logout</a>
        </li>
        <li class="nav-item right-side">
            <a class="nav-link" href="#"></a>
        </li>
    </ul>
</nav>
<!-- Form end -->
<script src="/js/app.js"></script>
<script>
    localStorage.setItem('token', "{{'Bearer '.$token}}")
    $.ajax({
        type: "GET",
        beforeSend: function(request) {
            request.setRequestHeader("Authorization", localStorage.getItem('token'));
        },
        url: "http://example.com/api/current",
        success: function(res) {
            $(".right-side > a").append(res.name);
        }
    });
</script>

<script>
    $('.logout-link').on('click', function () {
        $.ajax({
            type: "GET",
            beforeSend: function(request) {
                request.setRequestHeader("Authorization", localStorage.getItem('token'));
            },
            url: "http://example.com/api/logout",
            complete: function() {
                localStorage.removeItem('token');
                $(location).attr('href', '/');
            }
        });
    });
</script>
@endsection

