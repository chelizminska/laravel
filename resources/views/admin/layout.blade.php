<style>
    .admin_layout{
        color: #888a85;
        font-size: 30px;
    }


    .categories a{
        color: #2ca02c;
        font-size: 24px;
        text-decoration: underline;
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
    .adding{
        text-align: right;
        color: darkgreen;
    }
    .message{
        border: 1px solid #000000;
        width: 300px;
        display: inline-block;
    }
    form{
        display: inline-block;
    }
</style>

<html>
<head>
    <title>Административная консоль</title>
</head>
<body>
    @if(Auth::user())
        <div class="user">
            <form method="get" action="/admin/logout">
                {{ Auth::user()['user_name'] }}
                | <input type="submit" value="Выйти">
            </form>
        </div>
    @endif
    <div class="admin_layout">
        Административная консоль
    </div>
    @yield('content')
</body>
</html>