<form action="/" method="get" class="search-form">
    <!-- TODO：今開いているのがおすすめなのかマイリストなのかを保持するためにデータを送る必要がある(defaultはおすすめ) -->
    @if (isset($tab))
    <input type="hidden" name="tab" value="{{ $tab }}">
    @endif
    <input type="text" class="search-form__input" name="keyword" placeholder="なにをお探しですか？" @if (isset($keyword)) value="{{ $keyword }}" @endif>
</form>
<nav>
    <ul class="header-navigation">
        @auth
        <li>
            <form action="/logout" method="post">
                @csrf
                <button class="header-navigation__logout">
                    ログアウト
                </button>
            </form>
        </li>
        @endauth
        @guest
        <li>
            <a href="/login" class="header-navigation__login">
                ログイン
            </a>
        </li>
        @endguest
        <li>
            <a href="/mypage" class="header-navigation__mypage">
                マイページ
            </a>
        </li>
        <li>
            <a href="/sell" class="header-navigation__sell">
                出品
            </a>
        </li>
    </ul>
</nav>