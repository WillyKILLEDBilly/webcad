@extends('layouts.app')

@section('content')
<div class="q-main-container container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Вхід</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Пошта</label>

                            <div class="col-md-6">
                                <input placeholder="email" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('Email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Пароль</label>

                            <div class="col-md-6">
                                <input placeholder="Пароль" id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Запам'ятати
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Вхід
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-4 col-md-offset-4">
                        <a href="{{url('login/google')}}" class="btn btn-block btn-social btn-google">
                          <span class="fa fa-google"></span>
                          Sign in with Google
                        </a>

                        <a href="{{url('login/facebook')}}" class="btn btn-block btn-social btn-facebook">
                          <span class="fa fa-facebook"></span>
                          Sign in with Facebook
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
