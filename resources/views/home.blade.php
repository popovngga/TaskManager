@extends('layout')

@section('content')
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item">
            <a id="users" class="nav-link" href="#">Users</a>
        </li>
        <li class="nav-item">
            <a id="author" class="nav-link" href="#">Author tasks</a>
        </li>
        <li class="nav-item">
            <a id="executor" class="nav-link" href="#">Executor tasks</a>
        </li>
        <li class="nav-item">
            <a class="nav-link logout-link" href="#">Logout</a>
        </li>
        <li class="nav-item right-side">
            <a class="nav-link" href="#"></a>
        </li>
    </ul>
</nav>

<div class="album py-5 bg-light">
    <div class="container">
        <div class="cabinet-users">
            @include('cabinet.users')
        </div>
        <div class="cabinet-author hidden">
            @include('cabinet.author')
        </div>
        <div class="cabinet-executor hidden">
            @include('cabinet.executor')
        </div>
   </div>
</div>



<div id="success-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog alert alert-success" role="alert">
        <h4 class="alert-heading">Successfully added task!</h4>
    </div>
</div>
<div id="error-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog alert alert-danger" role="alert">
        <h4 class="alert-heading">Something went wrong!</h4>
    </div>
</div>

<div id="welcome-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog alert alert-primary" role="alert">
        <h4 class="alert-heading current"></h4>
    </div>
</div>

<!-- Form end -->
<script src="/js/app.js"></script>
<script>
    $('.logout-link').on('click', function () {
        $.ajax({
            type: "GET",
            beforeSend: function(request) {
                request.setRequestHeader("Authorization", localStorage.getItem('token'));
            },
            url: "/api/logout",
            complete: function() {
                localStorage.removeItem('token');
                $(location).attr('href', '/');
            }
        });
    });
</script>
    <script>
        function adderRemover(showerClass) {
            $('*[class^="cabinet"]').addClass('hidden');
            $(showerClass).removeClass('hidden');
        }
   </script>

<script>
    $(document).ready(function(){
        $.ajax({
            type: "GET",
            beforeSend: function(request) {
                request.setRequestHeader("Authorization", localStorage.getItem('token'));
            },
            url: "/api/current",
            success: function(res) {
                $(".current").append("Hello, "+ res.name + ", click something in the navigation menu to download information!");
                $("#welcome-modal").modal("show");
            }
        });
        $(".nav-item a").click(function(){
            $(".active").removeClass("active");
            $(this).addClass("active");
            if($(this).attr('id') === 'users') {
                adderRemover('.cabinet-users');
            } else if ($(this).attr('id') === 'executor') {
                adderRemover('.cabinet-executor');
            } else if ($(this).attr('id') === 'author') {
                adderRemover('.cabinet-author');
            }
        });
        window.history.pushState({}, document.title, "/home");

    });
</script>
@endsection

