@extends('core::layouts.app')

@section('bodyClass')
    class="text-left"
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/selectivity/css/selectivity-jquery.css') }}">
@endpush

@section('content')
    <div class="app-admin-wrap layout-horizontal-bar">
        <div class="main-content-wrap d-flex flex-column">
            <div class="main-content">
                <div class="breadcrumb">
                    <h1>Create user</h1>
                    <ul>
                        <li><a href="#">Users</a></li>
                        <li>Create User</li>
                    </ul>
                </div>
                <div class="separator-breadcrumb border-top"></div>
                <!--  end of row -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="card text-left">
                            <div class="card-body">
                                <div class="row user-info-wrap">
                                    <div class="col-lg-3 col-md-4 col-sm-12 left-side">
                                        <div class="user-info-tab">
                                            <h4>User information</h4>
                                            <ul class="nav nav-pills " id="myPillTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="home-icon-pill"
                                                       data-toggle="pill"
                                                       href="#accountPIll" role="tab"
                                                       aria-controls="accountPIll"
                                                       aria-selected="true">
                                                        Account</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="profile-icon-pill"
                                                       data-toggle="pill"
                                                       href="#permissionsPIll" role="tab"
                                                       aria-controls="permissionsPIll"
                                                       aria-selected="false">
                                                        Permissions</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-12 right-side">
                                        <div class="tab-content" id="myPillTabContent">
                                            @include('user::users.partials.create_form')
                                            @include('user::users.partials.permissions')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  end of col -->
                </div>
                <!--  end of row -->
                <!-- end of main-content -->
            </div><!-- Footer Start -->
        </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/plugins/selectivity/js/selectivity-jquery.js') }}"></script>
    <script src="{{ asset('assets/plugins/selectivity/js/main.js') }}"></script>
@endpush
