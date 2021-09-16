<?php
include_once __DIR__ . "../../db/ConnectDB.php";


spl_autoload_register(function($class_name) {

    $servDir = $_SERVER['DOCUMENT_ROOT'];
    $dirs = array(
        $servDir . '/app/Controllers/',
        $servDir . '/app/Views/',
        $servDir . '/app/Models/',
    );

    foreach( $dirs as $dir ) {
        if (file_exists($dir.$class_name.'.php')) {
            require_once($dir.$class_name.'.php');
            return;
        }
    }
});


$data = $_POST;

if($_SERVER['REQUEST_URI'] == '/') {
    $start = new StartController();
    $start->action();
}


if($_SERVER['REQUEST_URI'] == '/registration') {
    $reg = new RegistrationController();
    /* Проверяем пользователя */
    $reg->identical($data['login'], $data['password']);
}

/* Выходим из режима создания задач */
if ($_SERVER['REQUEST_URI'] == '/signout'){
    $_SESSION = [];
    header('Location: /');
}

if($_SERVER['REQUEST_URI'] == '/task-list'){

    $task = new TaskController($_SESSION['user']);
    /* Управление списком задач */
    $task->controlTask($data);
}


