<?php
// Подключение к БД
class ConnectDB
{
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $database = "tasklist";

    /*
     * Возвращает соединение
     */
    public function getConnect()
    {
        return new mysqli($this->servername, $this->username, $this->password, $this->database);
    }

    /*
     * Закрывает соединение
     */
    public function closeConnect()
    {
        return self::getConnect()->close();
    }
}
