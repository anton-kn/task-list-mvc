<?php
include_once __DIR__ . "../../db/connectDB.php";
include_once "Route.php";

/* Устанавливаем соединение с БД */
$db = new mysqli($connect['servername'], $connect['username'], $connect['password'], $connect['database']);

/* Загружаем классы */
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

Route::start();


