<div class="p-8 bg-gray-200 h-screen">
    <div class="text-center p-3 bg-green-200 hover:bg-green-300 rounded-lg w-24">
        <a class="" href="/">Домой</a>
    </div>
    <div class="w-50 p-2 text-center">
        <h1>Авторизация/Регистрация</h1>
        <p class="text-red-500"> <?php echo $content['error']; ?></p>
        <form action="/registration" method="post">
            <input class="mx-auto m-4 p-3 rounded-lg block" type="text" name="login" placeholder="Введите login">
            <input class="mx-auto m-4 p-3 rounded-lg block" type="password" name="password"
                   placeholder="Введите пароль">
            <button class="p-3 bg-green-400 rounded-lg" name="do_login">Вход</button>
        </form>
    </div>
</div>
