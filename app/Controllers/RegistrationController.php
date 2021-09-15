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

}