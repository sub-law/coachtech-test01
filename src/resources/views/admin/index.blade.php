@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('header-links')
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="header__link logout-btn">logout</button>
</form>
@endsection

@section('content')
<div class="admin-container">
    <h1 class="admin-heading">Admin</h1>

    <form method="GET" action="{{ route('admin.search') }}" class="search-form">
        <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください">

        <select name="gender">
            <option value="">性別</option>
            <option value="1">男性</option>
            <option value="2">女性</option>
            <option value="3">その他</option>
        </select>

        <select name="category_id">
            <option value="">お問い合わせ種類</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->content }}</option>
            @endforeach
        </select>

        <input type="date" name="date">

        <button type="submit" class="search-btn">検索</button>
        <a href="{{ route('admin.index') }}" class="reset-btn">リセット</a>

    </form>

    <div class="admin-table-wrapper">
        <div class="pagination-top">
            <a href="{{ route('admin.export', request()->query()) }}" class="export-btn">エクスポート</a>
            {{ $contacts->links('pagination::default') }}
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->full_name }}</td>
                    <td>{{ $contact->gender_label }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category_name }}</td>
                    <td><button class="detail-btn" data-id="{{ $contact->id }}">詳細</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <div class="modal" id="detail-modal">
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <div class="modal-body">

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const detailButtons = document.querySelectorAll('.detail-btn');
                        const modal = document.getElementById('detail-modal');
                        const modalBody = modal.querySelector('.modal-body');
                        const deleteForm = document.getElementById('delete-form');
                        const closeBtn = document.querySelector('.modal-close');

                        detailButtons.forEach(button => {
                            button.addEventListener('click', function() {
                                const contactId = this.dataset.id;

                                fetch(`/admin/contact/${contactId}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        modalBody.innerHTML = `
                        <p><strong>お名前：</strong> ${data.full_name}</p>
                        <p><strong>性別：</strong> ${data.gender_label}</p>
                        <p><strong>メール：</strong> ${data.email}</p>
                        <p><strong>電話番号：</strong> ${data.tel}</p>
                        <p><strong>住所：</strong> ${data.address}</p>
                        <p><strong>建物名：</strong> ${data.building}</p>
                        <p><strong>お問い合わせの種類：</strong> ${data.category_name}</p>
                        <p><strong>お問い合わせ内容：</strong><br>${data.detail}</p>
                    `;
                                        deleteForm.action = `/admin/contact/${contactId}`;
                                        modal.style.display = 'block';
                                    });
                            });
                        });

                        closeBtn.addEventListener('click', function() {
                            modal.style.display = 'none';
                        });
                    });
                </script>

            </div>
            {{-- <form method="POST" action="" id="delete-form"> --}}
            <form method="POST" action="#" id="delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">削除</button>
            </form>
        </div>
    </div>
    @endsection