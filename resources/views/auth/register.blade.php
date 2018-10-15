@extends('layout.layout')

@section('content')
<div class="container">
    <div class="column">
        <div class="box column is-half is-offset-one-quarter">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-title">
                        {{ __('Register') }}
                    </div>
                </div>
                <div class="card-content">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="field">
                            <label for="name" class="label">{{ __('Name') }}</label>

                            <input id="name" type="text" class="input {{ $errors->has('name') ? ' is-danger' : '' }}" name="name" 
                                value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <p class="help is-danger">
                                    {{ $errors->first('name') }}
                                </p>
                            @endif
                        </div>

                        <div class="field">
                            <label for="email" class="label">{{ __('E-Mail Address') }}</label>

                            <input id="email" type="email" class="input {{ $errors->has('email') ? ' is-danger' : '' }}" 
                                name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <p class="help is-danger">
                                    {{ $errors->first('email') }}
                                </p>
                            @endif
                        </div>

                        <div class="field">
                            <label for="password" class="label">{{ __('Password') }}</label>

                            <input id="password" type="password" class="input {{ $errors->has('password') ? ' is-danger' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <p class="help is-danger">
                                    {{ $errors->first('password') }}
                                </p>
                            @endif
                        </div>

                        <div class="field">
                            <label for="password-confirm" class="label">{{ __('Confirm Password') }}</label>

                            <input id="password-confirm" type="password" class="input" name="password_confirmation" required>
                        </div>

                        <div class="field">
                            <div>
                                <button type="submit" class="button is-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
