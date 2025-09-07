@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('header-links')
<a href="{{ route('register') }}" class="header__link">register</a>
@endsection

@section('content')
<div class="login-container">
    <h1 class="login-heading">Login</h1>

    @if (session('status'))
    <div class="login-status">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="ex. test@example.com" required>
            @error('email')
            <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">パスワード</label>
            <input id="password" type="password" name="password" placeholder="ex. **********" required>
            @error('password')
            <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-button">
            <button type="submit">ログイン</button>
        </div>
    </form>
</div>
@endsection