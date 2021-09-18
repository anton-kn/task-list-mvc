<?php

class TaskController extends Controller
{
    private $model;
    private $userFormSession;

    public function __construct($userFormSession)
    {
        $this->model = new Task();
        parent::__construct();
        $this->userFormSession = $userFormSession;
    }

    /* Показываем все, имеющиеся задачи */
    public function allTask()
    {
        $data = $this->model->showTaskAll($this->userFormSession);
        $this->view->showPage('task-list', [
            'title' => 'Список задач',
            'tasks' => $data
        ]);
    }

    /* Отбражаем ошибку и все задачи */
    public function taskError($error)
    {
        $data = $this->model->showTaskAll($this->userFormSession);
        $this->view->showPage('task-list', [
            'title' => 'Список задач',
            'tasks' => $data,
            'error' => $error
        ]);

    }

    /* Добавляем одну задачу */
    private function addOneTask()
    {
        $this->model->addTask($this->userFormSession, $this->dataPost['description']);
        /* Показываем все задачи */
        $this->allTask();
    }

    /* Удалим все задачи */
    private function delAllTasks(){

        $this->model->deleteAll($this->userFormSession);
        $this->view->showPage('task-list', [
            'title' => 'Список задач'
        ]);
    }

    /* Удаляем одну задачу*/
    private function delTaskOne()
    {
        $this->model->deleteTaskOne($this->userFormSession, $this->dataPost['status']);
        /* Показываем все задачи */
        $this->allTask();
    }

    /* Записываем всем задачам - выполнено/готово */
    private function readyAll()
    {
        $this->model->statusConfirmAll($this->userFormSession);
        $this->allTask();
    }

    /* Присваиваем одной задаче - выполнено/готово */
    private function readyOne()
    {
        $this->model->statusConfirmOne($this->userFormSession, $this->dataPost['status']);
        $this->allTask();
    }

    public function controlAll()
    {
        /* Удаляем все данные с таблицы tasks */
        if(isset($this->dataPost['delete-all'])){
            $this->delAllTasks();
        }

        // Статус на все задачи - все выполнено
        if(isset($this->dataPost['ready-all'])){
            $this->readyAll();
        }
        $this->allTask();

    }

    public function addTask()
    {
        /*Добавляем задачу */
        if(isset($this->dataPost['add-task'])){
            /*Добавляем статью */
            if(empty($this->dataPost['description'])){
                $this->taskError("Напишите задание");
            }else{
                $this->addOneTask();
            }
        }
        $this->allTask();
    }


    public function controlOne()
    {
        // Для случая, если страница только перезагружается
        if(empty($this->dataPost)){
            // Сюда запишем содержание с таблицы tasks
            $this->allTask();
        }

        // Удаляем одну задачу
        if(isset($this->dataPost['delete-task'])){
            if (!$this->dataPost['status']){
                $this->taskError("Выберите задачу для удаления");
            }else{
                $this->delTaskOne();
            }
            $this->allTask();
        }

        // Статус на одну задачу - выполнено/не выполнено
        if(isset($this->dataPost['ready-task'])){
            if(!$this->dataPost['status']){
                $this->taskError("Выберите задачу для изменения");
            }else{
                $this->readyOne();
            }
            $this->allTask();
        }
    }

}