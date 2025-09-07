<!DOCTYPE html>
<html lang="ja">

    <head>
        <meta charset="UTF-8">
        <title>お問い合わせ完了</title>
        <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
    </head>

    <body>
        <div class="thanks-wrapper">
            <div class="background-text">Thank you</div>
            <div class="thanks-box">
                <p class="message">お問い合わせありがとうございました</p>
                <a href="{{ route('create') }}" class="home-button">HOME</a>
            </div>
        </div>
    </body>

</html>