<header>
    <nav>
        <ul style="display: flex; list-style: none; margin: 0; padding: 0;">
            @if (Auth::check())
                <li style="margin-right: 12px;"><a href="/profile">Мой профиль</a></li>
            @endif
            <li style="margin-right: 12px;"><a href="/projects">Проекты</a></li>
            <li style="margin-right: 12px;"><a href="/authors">Авторы</a></li>

            @if (!Auth::check())
                <li style="margin-right: 12px;"><a href="/login">Войти</a></li>                
                <li><a href="/register">Зарегистрироваться</a></li>
            @else
                <form action="/logout" method="POST">
                    @csrf

                    <li><a href="#" onclick="event.preventDefault(); this.closest('form').submit();">Выйти</a></li>
                </form>
            @endif

        </ul>
    </nav>
</header>