@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('header-links')
<div class="header-links">
    <a href="{{ route('login') }}" class="header__link">login</a>
</div>
@endsection

@section('content')
<div class="register-container">
    <h1 class="register-heading">Register</h1>

    <form method="POST" action="{{ route('register') }}" class="register-form">
        @csrf

        <div class="form-group">
            <label for="name">お名前</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="例: 山田 太郎" required>
            @error('name')
            <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="例: sample@example.com" required>
            @error('email')
            <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">パスワード</label>
            <input id="password" type="password" name="password" placeholder="例: cinderellaweb" required>
            @error('password')
            <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">パスワード（確認）</label>
            <input id="password_confirmation" type="password" name="password_confirmation" placeholder="もう一度入力してください" required>
            @error('password_confirmation')
            <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-button">
            <button type="submit">登録</button>
        </div>
    </form>
</div>
@endsection