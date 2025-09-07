@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/create.css') }}" />
@endsection


@section('content')
<main>
    <div class="contact-form__content">
        <h2 class="contact-form__heading">contact</h2>

        <form class="form" action="/confirm" method="post" novalidate>
            @csrf

            <div class="form__group">
                <div class="form__group-title">
                    <label class="form__label--item" for="last_name">お名前</label>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content is-row-2">
                    <div class="form__input--text">
                        <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="姓（例：山田）" required>
                    </div>
                    @error('last_name')
                    <div class="form__error">{{ $message }}</div>
                    @enderror
                    <div class="form__input--text">
                        <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="名（例：太郎）" required>
                    </div>
                    @error('first_name')
                    <div class="form__error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">性別</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <label><input type="radio" name="gender" value="1" checked> 男性</label>
                    <label><input type="radio" name="gender" value="2"> 女性</label>
                    <label><input type="radio" name="gender" value="3"> その他</label>
                    <div class="form__error" aria-live="polite"></div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <label class="form__label--item" for="email">メールアドレス</label>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="test@example.com" required>
                    </div>
                    @error('email')
                    <div class="form__error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <label class="form__label--item" for="tel1">電話番号</label>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content is-row-3">
                    <div class="form__input--text">
                        <input id="tel1" type="text" inputmode="numeric" pattern="\d*" name="tel1" value="{{ old('tel1') }}" placeholder="080" required>
                    </div>
                    @error('tel1')
                    <div class="form__error">{{ $message }}</div>
                    @enderror
                    <div class="form__input--text">
                        <input id="tel2" type="text" inputmode="numeric" pattern="\d*" name="tel2" value="{{ old('tel2') }}" placeholder="1234" required>
                    </div>
                    @error('tel2')
                    <div class="form__error">{{ $message }}</div>
                    @enderror
                    <div class="form__input--text">
                        <input id="tel3" type="text" inputmode="numeric" pattern="\d*" name="tel3" value="{{ old('tel3') }}" placeholder="5678" required>
                    </div>
                    @error('tel3')
                    <div class="form__error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <label class="form__label--item" for="address">住所</label>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input id="address" type="text" name="address" value="{{ old('address') }}" placeholder="東京都〇〇区〇〇町3-2-3" required>
                    </div>
                    @error('address')
                    <div class="form__error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <label class="form__label--item" for="building">建物名</label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input id="building" type="text" name="building" value="{{ old('building') }}" placeholder="〇〇マンション101">
                    </div>
                    @error('building')
                    <div class="form__error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <label class="form__label--item" for="type">お問い合わせの種類</label>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <div class="form__input--text is-half">
                            <select id="category_type" name="category_type" required>
                                <option value="" selected>選択してください</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_type') == $category->id ? 'selected' : '' }}>
                                    {{ $category->content }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @error('category_type')
                    <div class="form__error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <label class="form__label--item" for="detail">お問い合わせ内容</label>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--textarea">
                        <textarea id="detail" name="detail" placeholder="お問い合わせ内容をご記載ください(120文字以内)" required>{{ old('detail') }}</textarea>
                    </div>
                    @error('detail')
                    <div class="form__error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form__button">
                <button class="form__button-submit" type="submit">送信する</button>
            </div>

        </form>
    </div>
</main>
@endsection