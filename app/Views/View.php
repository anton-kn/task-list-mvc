<?php
/*
 * Основной класс отвечающий за отбражение
 */
class View
{
    public function showPage($additionalView, $content = []){
        include_once "includes/header.php";
        include_once "public/" . $additionalView . ".php";
        include_once "includes/footer.php";
    }
}