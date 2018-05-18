@extends('layout.layout')

@section('content')
<div class="container">
    <div class="column">
        <div class="box column is-half is-offset-one-quarter">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-title">
                        {{ __('Login') }}
                    </div>
                </div>
                <div class="card-content">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="field">
                            <label for="email" class="label">{{ __('E-Mail Address') }}</label>

                            <div class="control has-icons-left">
                                <input id="email" type="email" class="input form-control{{ $errors->has('email') ? ' is-danger' : '' }}" 
                                    placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <label for="password" class="label">{{ __('Password') }}</label>

                            <div class="control has-icons-left">
                                <input id="password" type="password" class="input form-control{{ $errors->has('password') ? ' is-danger' : '' }}" 
                                    placeholder="Password" name="password" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-key"></i>
                                </span>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-primary">
                                    {{ __('Login') }}
                                </button>

                                <a class="button is-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <div>
    </div>
</div>
@endsection
