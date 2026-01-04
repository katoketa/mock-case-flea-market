<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
    <title>Document</title>
</head>
<body>
    <header class="header">
        <a href="/" class="header__title">
            <img src="{{ asset('image/COACHTECHヘッダーロゴ.png" alt="COACHTECH">
        </a>
        @yield('nav')
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>