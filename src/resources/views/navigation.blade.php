<form action="/" method="get" class="search-form">
    <!-- TODO：今開いているのがおすすめなのかマイリストなのかを保持するためにデータを送る必要がある(defaultはおすすめ) -->
    <input type="text" class="search-form__input" placeholder="なにをお探しですか？">
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
            <form action="/login" method="post">
                <button class="header-navigation__login">
                    ログイン
                </button>
            </form>
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