<?php
/*
 * Класс отвечающий за регистрацию
 */
class UserController extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new User();
    }

    public function action()
    {
        $this->view->showPage('registration', [
            'title' => 'Авторизация/Регистрация'
        ]);
    }

    public function actionError($error)
    {
        $this->view->showPage('registration',[
            'title' => 'Авторизация/Регистрация',
            'error' => $error
        ]);
    }

    /* Проверяем пользователя */
    public function checkUser()
    {
        return $this->model->findUser($this->login);
    }

    /* Записываем нового пользователя */
    public function newUser()
    {
        return $this->model->insertUser($this->login, $this->password);
    }

    // ищем одинаковых пользователей
    public function identical()
    {
        /* авторизация */
        if (isset($this->login)) {
            $user = $this->checkUser($this->login);
            /*Проверяем совпадение введенных пользователем данных*/
            if ($user['login'] == $this->login) {

                if (trim($this->login) == '') {
                    $this->actionError("Введите login");
                }

                if (trim($this->password) == '') {
                    $this->actionError("Введите password");
                }

                if ( password_verify($this->password, $user['password']) ) {
                    /*
                     * Записываем в сессию пользователя
                     * Переходим на главную страницу
                    */
                    /* Защита от XSS */
                    $loginSpecial = htmlspecialchars($this->login, ENT_QUOTES, 'UTF-8');
                    $_SESSION['user'] = $loginSpecial;
                    /* Перходим на начальную страницу с зарегистрированым пользователем */
                    header('Location: /task-list');

                } else {
                    $this->actionError("Не правильно введен пароль");
                }
            } else {
                /* Если пользователя нет в БД
                * регистрируем
                */
                if (trim($this->login) == '') {
                    $this->actionError("Введите login");
                }

                if (trim($this->password) == '') {
                    $this->actionError("Введите password");
                } else {
                    // хешируем пароль
                    $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
                    $this->newUser($this->login, $passwordHash);
                    /* Защита от XSS */
                    $loginSpecial = htmlspecialchars($login, ENT_QUOTES, 'UTF-8');
                    $_SESSION['user'] = $loginSpecial;
                     // Перходим на начальную страницу с зарегистрированым пользователем
                    header('Location: /task-list');
                }
            }
        }else{
            $this->action();
        }
        $this->model->close();
    }
}