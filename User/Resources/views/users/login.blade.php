@extends('core::layouts.app')

@section('meta')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
@endsection

@section('title')
    Login səhifəsi
@endsection

@section('content')
    <div class="auth-layout-wrap" style="background-image: url({{ asset('assets/images/photo-wide-4.jpg') }})">
        <div class="auth-content auth-signin">
            <div class="card o-hidden">
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-4">
                            <div class="auth-logo text-center mb-4"><img src="{{ asset('assets/images/logo.png') }}" alt="">
                            </div>
                            <h1 class="mb-3 text-18">Sign In</h1>
{{--                            @include('core::flash')--}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('admin.login') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="username">Login</label>
                                    <input class="form-control form-control-rounded" id="username" name="username">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input class="form-control form-control-rounded" name="password" id="password" type="password">
                                </div>
                                <button type="submit" class="btn btn-rounded btn-primary btn-block mt-2">Sign In</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
