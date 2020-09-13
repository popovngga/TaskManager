@extends('layout')
@section('content')
        <style>
            body {
                font-family: 'Nunito';
                display: flex;
                justify-content: center;
                height: 100%;
                width: 100%;
            }
            form {
                position:absolute; top:40%;
            }
            a:hover {
                -webkit-box-shadow: 40px 24px 48px 25px rgba(158,46,109,1) !important;
                -moz-box-shadow: 40px 24px 48px 25px rgba(158,46,109,1) !important;
                box-shadow: 40px 24px 48px 25px rgba(158,46,109,1) !important;
            }
            a {
                font-weight: bold !important;
                border-radius: 100px !important;
                width:500px;height:200px;
                font-size: 34px !important;
                display: flex !important;
                align-items: center;
                justify-content: center;
            }
        </style>
                <form>
                    <a href="{{ url('/login/google') }}" class="btn btn-danger btn-customized">Login / Register</a>
                </form>
                <!-- Form end -->
@endsection

