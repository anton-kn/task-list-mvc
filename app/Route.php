<?php

class Route
{
    public static function start()
    {

        if($_SERVER['REQUEST_URI'] == '/') {
            $start = new StartController();
            $start->action();
        }

        if($_SERVER['REQUEST_URI'] == '/registration') {
            $reg = new UserController();
            /* Проверяем пользователя */
            $reg->registration();
        }

        if($_SERVER['REQUEST_URI'] == '/registration/identical') {
            $reg = new UserController();
            /* Проверяем пользователя */
            $reg->identical();
        }

        /* Выходим из режима создания задач */
        if ($_SERVER['REQUEST_URI'] == '/signout'){
            $_SESSION = [];
            header('Location: /');
        }

        if($_SERVER['REQUEST_URI'] == '/task-list'){
            $task = new TaskController($_SESSION['user']);
            /* Покажем все задачи */
            $task->allTask();
        }

        if($_SERVER['REQUEST_URI'] == '/task-list/add-task'){
            $task = new TaskController($_SESSION['user']);
            /* Добавим задачу */
            $task->addTask();
        }

        if($_SERVER['REQUEST_URI'] == '/task-list/control-all' ){
            $task = new TaskController($_SESSION['user']);
            /* Управление списком всех задач */
            $task->controlAll();
        }

        if($_SERVER['REQUEST_URI'] == '/task-list/control-one'){
            $task = new TaskController($_SESSION['user']);
            /* Управление одной задачей */
            $task->controlOne();
        }
    }
}