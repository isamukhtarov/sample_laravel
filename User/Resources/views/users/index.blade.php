@extends('core::layouts.app')

@section('content')
<div class="main-content-wrap d-flex flex-column">
    <div class="main-content">
        <div class="breadcrumb">
            <h1>Users</h1>
            <ul>
                <li><a href="href">Dashboard</a></li>
                <li>Users</li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <div class="create-btn">
            <a href="{{ route('user.create') }}" class="btn">Create User</a>
        </div>
        <div class="row mb-4">
            <div class="col-md-12 mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Принадлежность к группе</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user['id'] }}</td>
                                        <td>{{ $user['email'] }}</td>
                                        <td>
                                            @foreach($user['roles'] as $role)
                                                {{ $role['display_name'] }}{{ !$loop->last ? ', ' : '' }}
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="action-column">
                                                <a href="{{ route('user.toggleBlock', ['id' => $user['id']]) }}" class="btn btn-success @if($user['is_blocked']) blocked-user @endif" type="button"><i class="nav-icon i-Administrator"></i></a>
                                                <a href="{{ route('user.edit', ['id' => $user['id']]) }}" class="btn btn-success edit-btn" type="button"><i class="nav-icon i-Pen-2"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-md-12 p-0">
                                {!! $users->links('core::partials.pagination') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
