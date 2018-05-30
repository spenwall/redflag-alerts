@extends('layout.layout')

@section('content')
<div class="container">
    <div class="column">
        <div class="box column is-half is-offset-one-quarter">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-title">
                    {{ __('Reset Password') }}
                    </div>
                </div>

                <div class="card-content">
                    @if (session('status'))
                        <div class="help is-link">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="field">
                            <label for="email" class="label">{{ __('E-Mail Address') }}</label>

                            <input id="email" type="email" class="input form-control{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help is-danger">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>

                        <div class="field">
                            <div>
                                <button type="submit" class="button is-primary">
                                    {{ __('Send Password Reset Link') }}
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
