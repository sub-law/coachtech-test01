@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection

@section('content')
    <main>
        <div class="container">
            <h1>Confirm</h1>
            
            <table class="confirm-table">
                <tr>
                    <th>お名前</th>
                    <td>{{ $inputs['full_name'] }}</td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td>{{ $inputs['gender_label'] }}</td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>{{ $inputs['email'] }}</td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>{{ $inputs['tel_full'] }}</td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td>{{ $inputs['address'] }}</td>
                </tr>
                <tr>
                    <th>建物名</th>
                    <td>{{ $inputs['building'] ?? '（未入力）' }}</td>
                </tr>
                <tr>
                    <th>商品のお問い合わせの種類</th>
                    <td>{{ $inputs['category_name'] }}</td>
                </tr>
                <tr>
                    <th>お問い合わせ内容</th>
                    <td>{!! nl2br(e($inputs['detail'])) !!}</td>
                </tr>
            </table>

            <div class="button-area">
                <form action="{{ route('store') }}" method="post">
                    @csrf
                    @foreach ($inputs as $name => $value)
                    <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                    @endforeach
                    <button type="submit" class="submit-btn">送信</button>
                </form>
                <form action="{{ route('create') }}" method="get">
                    <button type="submit" class="edit-btn">修正する</button>
                </form>
            </div>
        </div>
    </main>
@endsection