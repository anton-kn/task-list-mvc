<?php
include_once __DIR__ . "../../db/ConnectDB.php";

spl_autoload_register(function ($class_name) {
    include "Models/" .$class_name . '.php';
});

spl_autoload_register(function ($class_name) {
    include "Controllers/" .$class_name . '.php';
});

spl_autoload_register(function ($class_name) {
    include "Views/" .$class_name . '.php';
});

if($_SERVER['REQUEST_URI'] == '/'){
    $start = new StartController();
    $start->action();
}

$data = $_POST;

if($_SERVER['REQUEST_URI'] == '/registration') {

    /* авторизация */
    if (isset($data['login'])) {

        $reg = new RegistrationController();

        if (trim($data['login']) == '') {
            $reg->actionError("Введите login");
        }

        $user = $reg->checkUser($data['login']);
        /*Проверяем совпадение введенных пользователем данных*/
        if ($user['login'] == $data['login']) {
            if (trim($data['password']) == '') {
                $reg->actionError("Введите password");
            }

            if ( password_verify($data['password'], $user['password']) ) {
                /*
                 * Записываем в сессию пользователя
                 * Переходим на главную страницу
                */
                $_SESSION['user'] = $data['login'];
                /* Перходим на начальную страницу с зарегистрированым пользователем */
                header('Location: /task-list');

            } else {
                $reg->actionError("Не правильно введен пароль");
            }
        } else {
            /* Если пользователя нет в БД
            * регистрируем
             */
            if (trim($data['password']) == '') {
                $reg->actionError("Введите password");
            } else {
                // хешируем пароль
                $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);
                $reg->newUser($data['login'], $passwordHash);
                $_SESSION['user'] = $data['login'];
                /* Перходим на начальную страницу с зарегистрированым пользователем */
                header('Location: /task-list');
            }
        }
    }else{
            $reg = new RegistrationController();
            $reg->action();
    }
}

/* Выходим из режима создания задач */
if ($_SERVER['REQUEST_URI'] == '/signout'){
    $_SESSION = [];
    header('Location: /');
}

if($_SERVER['REQUEST_URI'] == '/task-list'){
    /*  */
    $task = new TaskController($_SESSION['user']);
// Для случая, если страница только перезагружается
    if(empty($data)){
        // Сюда запишем содержание с таблицы tasks
        $task->allTask();
    }

    /*Добавляем задачу */
    if(isset($data['add-task'])){
        /*Добавляем статью */
        if(empty($data['description'])){
            $task->taskError("Напишите задание");
        }else{
            $task->addOneTask($data['description']);
        }
    }

    /* Удаляем все данные с таблицы tasks */
    if(isset($data['delete-all'])){
        $task->delAllTasks();
    }

    // Удаляем одну задачу
    if(isset($data['delete-task'])){
        if (!$data['status']){
            $task->taskError("Выберите задачу для удаления");
        }else{
            $task->delTaskOne($data['status']);
        }
        $task->allTask();
    }

    // Статус на все задачи - все выполнено
    if(isset($data['ready-all'])){
        $task->readyAll();
    }

    // Статус на одну задачу - выполнено/не выполнено
    if(isset($data['ready-task'])){
        if(!$data['status']){
            $task->taskError("Выберите задачу для изменения");
        }else{
            $task->readyOne($data['status']);
        }
    }
}


