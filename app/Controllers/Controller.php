<?php

/*
 * Контроллер - родитель
 */
class Controller
{
    protected $dataPost;
    protected $login;
    protected $password;
    protected $view;
    // protected $userFormSession;

    public function __construct()
    {
        $this->view = new View();
        $this->login = $_POST['login'];
        $this->password = $_POST['password'];
        $this->dataPost = $_POST;
    }

    public function action()
    {

    }

}