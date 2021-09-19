<?php

/*
 * Контроллер - родитель
 */
class Controller
{
    protected $dataPost;
    protected $view;
    // protected $userFormSession;

    public function __construct()
    {
        $this->view = new View();
        $this->dataPost = $_POST;
    }

    public function action()
    {

    }

}