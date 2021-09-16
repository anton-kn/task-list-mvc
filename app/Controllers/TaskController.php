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

    /* Показываем все, имеющиеся задачи */
    public function allTask()
    {
        $data = $this->model->showTaskAll($this->login);
        $this->view->showPage('task-list', [
            'title' => 'Список задач',
            'tasks' => $data
        ]);
    }

    /* Отбражаем ошибку и все задачи */
    public function taskError($error)
    {
        $data = $this->model->showTaskAll($this->login);
        $this->view->showPage('task-list', [
            'title' => 'Список задач',
            'tasks' => $data,
            'error' => $error
        ]);
    }

    /* Добавляем одну задачу */
    public function addOneTask($description)
    {
        $this->model->addTask($this->login, $description);
        /* Показываем все задачи */
        self::allTask();
    }

    /* Удалим все задачи */
    public function delAllTasks(){

        $this->model->deleteAll($this->login);
        $this->view->showPage('task-list', [
            'title' => 'Список задач'
        ]);
    }

    /* Удаляем одну задачу*/
    public function delTaskOne($valueStatus)
    {
        $this->model->deleteTaskOne($this->login, $valueStatus);
        /* Показываем все задачи */
        self::allTask();
    }

    /* Записываем всем задачам - выполнено/готово */
    public function readyAll()
    {
        $this->model->statusConfirmAll($this->login);
        self::allTask();
    }

    /* Записываем одной задаче - выполнено/готово */
    public function readyOne($valueStatus)
    {
        $this->model->statusConfirmOne($this->login, $valueStatus);
        self::allTask();
    }


    /* метод для удаления всех задач, для удаления одной задачи,
    * для подтвержения всех задач, для подтвержения одной задачи,
    * для добавления задачи
    */
    public function controlTask($call)
    {
        // Для случая, если страница только перезагружается
        if(empty($call)){
            // Сюда запишем содержание с таблицы tasks
            self::allTask();
        }

        /*Добавляем задачу */
        if(isset($call['add-task'])){
            /*Добавляем статью */
            if(empty($call['description'])){
                self::taskError("Напишите задание");
            }else{
                self::addOneTask($call['description']);
            }
        }


        /* Удаляем все данные с таблицы tasks */
        if(isset($call['delete-all'])){
            self::delAllTasks();
        }

        // Удаляем одну задачу
        if(isset($call['delete-task'])){
            if (!$call['status']){
                self::taskError("Выберите задачу для удаления");
            }else{
                self::delTaskOne($call['status']);
            }
            self::allTask();
        }

        // Статус на все задачи - все выполнено
        if(isset($call['ready-all'])){
            self::readyAll();
        }

        // Статус на одну задачу - выполнено/не выполнено
        if(isset($call['ready-task'])){
            if(!$call['status']){
                self::taskError("Выберите задачу для изменения");
            }else{
                self::readyOne($call['status']);
            }
        }
    }
}