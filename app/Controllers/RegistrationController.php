<?php
/*
 * Класс отвечающий за регистрацию
 */
class RegistrationController extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Registration();
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
    public function checkUser($login)
    {
        return $this->model->findUser($login);
    }

    /* Записываем нового пользователя */
    public function newUser($login, $password)
    {
        return $this->model->insertUser($login, $password);
    }

    // ищем одинаковых пользователей
    public function identical($login, $password)
    {
        /* авторизация */
        if (isset($login)) {

            // $reg = new RegistrationController();

            $user = self::checkUser($login);
            /*Проверяем совпадение введенных пользователем данных*/
            if ($user['login'] == $login) {

                if (trim($login) == '') {
                    self::actionError("Введите login");
                }

                if (trim($password) == '') {
                    self::actionError("Введите password");
                }

                if ( password_verify($password, $user['password']) ) {
                    /*
                     * Записываем в сессию пользователя
                     * Переходим на главную страницу
                    */
                    $_SESSION['user'] = $login;
                    /* Перходим на начальную страницу с зарегистрированым пользователем */
                    header('Location: /task-list');

                } else {
                    self::actionError("Не правильно введен пароль");
                }
            } else {
                /* Если пользователя нет в БД
                * регистрируем
                 */
                if (trim($login) == '') {
                    self::actionError("Введите login");
                }

                if (trim($password) == '') {
                    self::actionError("Введите password");
                } else {
                    // хешируем пароль
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    self::newUser($login, $passwordHash);
                    $_SESSION['user'] = $login;
                     // Перходим на начальную страницу с зарегистрированым пользователем
                    header('Location: /task-list');
                }
            }
        }else{
                // $reg = new RegistrationController();
                self::action();
        }

    }


}