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

    public function registration()
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
        return $this->model->findUser($this->dataPost['login']);
    }

    /* Записываем нового пользователя */
    public function newUser($password)
    {
        return $this->model->insertUser($this->dataPost['login'], $password);
    }


    // ищем одинаковых пользователей
    public function identical()
    {
        /* авторизация */
        if (isset($this->dataPost['login'])) {
            $user = $this->checkUser($this->dataPost['login']);
            /*Проверяем совпадение введенных пользователем данных*/
            if ($user['login'] == $this->dataPost['login']) {

                if (trim($this->dataPost['login']) == '') {
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
                    $loginSpecial = htmlspecialchars($this->dataPost['login'], ENT_QUOTES, 'UTF-8');
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
                if (trim($this->dataPost['login']) == '') {
                    $this->actionError("Введите login");
                }

                if (trim($this->password) == '') {
                    $this->actionError("Введите password");
                } else {
                    // хешируем пароль
                    $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
                    $this->newUser($passwordHash);
                    /* Защита от XSS */
                    $loginSpecial = htmlspecialchars($this->dataPost['login'], ENT_QUOTES, 'UTF-8');
                    $_SESSION['user'] = $loginSpecial;
                     // Перходим на начальную страницу с зарегистрированым пользователем
                    header('Location: /task-list');
                }
            }
        }else{
            $this->registration();
        }
    }
}