<?php


class Model
{
	protected $connectionDb;
    protected $closeConnectionDb;

    public function __construct()
    {
        $this->connectionDb = $GLOBALS['connect']->getConnect(); // открываем соединение
        $this->closeConnectionDb = $GLOBALS['connect']->closeConnect(); // закрываем соединение;
    }

    /* Закрываем соединение */
    public function close()
    {
    	 $this->closeConnectionDb;
    }
}