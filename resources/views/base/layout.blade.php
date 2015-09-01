<style>
    body{
        color: #0a0137;
        background-color: #c0a16b;
        width: 1300px;
    }
    .menu{
        font-size: 30px;
        background-color: white;
        border-radius: 5px;
        margin-left: 100px;
    }
    a{
        text-decoration: none;
        color: #843534;
    }
    .menu li{
        display: inline-block;
        margin-right: 20px;
    }
    .menu a{
        text-decoration: none;
        color: #3D7700;
    }
    .fishes{
        color: #BE5C00;
        font-size: 22px;
        font-style: italic;
    }
    .fishes h1{
        color: #BE5C00;
        font-size: 30px;
    }
    .content{
        margin-left: 30px;
    }
    .error{
        color: red;
    }
    .user{
        text-align: right;
    }
    .login{
        font-size: 20px;
    }
    .login input{
        text-align: center;
        font-size: 15px;
        border-radius: 8px;
    }
    .register a{
        color: #204d74;
        text-decoration: underline;
    }
</style>

<html>
<head>
    <title>Laravel</title>
</head>
<body>
    <div class="menu">
        <ul>
            <li><a href="/">Главная</a></li>
            <li><a href="/forum">Форум</a></li>
            <li><a href="/fishes">Рыбы беларуси</a></li>
            <li><a href="/news">Новости</a></li>
            <li><a href="/about">О клубе</a></li>
            <li><a href="/contacts">Контакты</a></li>
        </ul>
    </div>
    <div class="user">
        <form method="get" @if(Auth::user()) action="/logout" @else action="/login" @endif>
            @if(Auth::user())
                {{ Auth::user()['name'] }}
                | <input type="submit" value="Выйти">
            @else
                Гость
                | <input type="submit" value="Войти">
                <div class="register">
                    <a href="/register">Еще не зарегистрированы?</a>
                </div>
            @endif
        </form>
    </div>
    <div class="content">
        @yield('content')
    </div>
</body>
</html>