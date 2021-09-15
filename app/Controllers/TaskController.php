<?php

class TaskController extends Controller
{
    private $model;
    private $login;

    public function __construct($login)
    {
        $this->model = new Task();
        parent::__construct();
        $this->login = $login;
    }

    public function allTask()
    {
        $data = $this->model->showTaskAll($this->login);
        $this->view->showPage('task-list', [
            'title' => 'Список задач',
            'tasks' => $data
        ]);
    }

    public function taskError($error)
    {
        $data = $this->model->showTaskAll($this->login);
        $this->view->showPage('task-list', [
            'title' => 'Список задач',
            'tasks' => $data,
            'error' => $error
        ]);
    }

    public function addOneTask($description)
    {
        /* Добавляем одну задачу */
        $this->model->addTask($this->login, $description);
        /* Показываем все задачи */
        self::allTask();
    }

    public function delAllTasks(){
        /* Удалим все задачи */
        $this->model->deleteAll($this->login);
        $this->view->showPage('task-list', [
            'title' => 'Список задач'
        ]);
    }

    public function delTaskOne($valueStatus)
    {
        $this->model->deleteTaskOne($this->login, $valueStatus);
        /* Показываем все задачи */
        self::allTask();
    }

    public function readyAll()
    {
        $this->model->statusConfirmAll($this->login);
        self::allTask();
    }

    public function readyOne($valueStatus)
    {
        $this->model->statusConfirmOne($this->login, $valueStatus);
        self::allTask();
    }
}