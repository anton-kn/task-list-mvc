<?php


/*
 * Начальная страница
 */
class StartController extends Controller
{
    public function __construct()
    {
        parent:: __construct();
    }

    public function action(){
        $this->view->showPage('start',
        [
            'title' => "Task-list"
        ]);
    }
}
