<?php
include_once __DIR__ . "../../db/ConnectDB.php";


$GLOBALS['connect'] = new ConnectDB();


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

    $task = new TaskController($userFormSession);
    /* Управление списком задач */
    $task->controlTask();
}


