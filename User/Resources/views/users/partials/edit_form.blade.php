<div class="tab-pane fade show active" id="accountPIll" role="tabpanel"
     aria-labelledby="home-icon-pill">
    <div class="main-content">
        <div class="row">
            <div class="col-md-12 p-0">
                <div class="title-link-wrap">
                    <h3 class="tab-content-title">Account</h3>
                    <a href="{{ route('user.toggleBlock', ['id' => $id]) }}" class="block-btn btn @if($user['is_blocked']) unblocked @endif">
                        {{ $user['is_blocked'] ? 'разблокировать' : 'заблокировать' }}
                    </a>
                </div>
                <form action="{{ route('user.update', ['id' => $id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="col-lg-8 acc-form-area p-0">
                        <div class="form-group">
                            <label class="col-sm-3" for="full-name">Full
                                Name</label>
                            <div class="col-sm-9 input-area">
                                <input type="text" class="form-control"
                                       id="full-name" name="full_name" value="{{ $user['full_name'] }}">
                                @if($errors->has('full_name'))
                                    <div class="invalid-feedback">{{ $errors->first('full_name') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3" for="phone">Phone</label>
                            <div class="col-sm-9 input-area">
                                <input type="tel" class="form-control"
                                       id="phone" name="phone" value="{{ $user['phone'] }}">
                                @if($errors->has('phone'))
                                    <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3" for="email">Email</label>
                            <div class="col-sm-9 input-area">
                                <input type="email" class="form-control"
                                       id="email" name="email" value="{{ $user['email'] }}">
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3" for="login">Login</label>
                            <div class="col-sm-9 input-area">
                                <input type="text" class="form-control"
                                       id="login" name="username" value="{{ $user['username'] }}">
                                @if($errors->has('username'))
                                    <div class="invalid-feedback">{{ $errors->first('username') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3">Roles</label>
                            <div class="col-sm-9 input-area">
                                <select name="roles[]" id="select-2" multiple>
                                    @foreach($roles as $role)
                                        <option value="{{ $role['id'] }}" @if(in_array($role['id'], $userRoles)) selected @endif>
                                            {{ $role['display_name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->has('roles'))
                                    <div class="invalid-feedback">{{ $errors->first('roles') }}</div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3"
                                   for="password">Password</label>
                            <div class="col-sm-9 input-area">
                                <input type="password" class="form-control"
                                       id="password" name="password">
                                @if($errors->has('password'))
                                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3" for="confirm-password">Confirm
                                password</label>
                            <div class="col-sm-9 input-area">
                                <input type="password" class="form-control"
                                       id="confirm-password" name="password_confirmation">
                                @if($errors->has('password_confirmation'))
                                    <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12 offset-md-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- end of main-content -->
    </div><!-- Footer Start -->
</div>

