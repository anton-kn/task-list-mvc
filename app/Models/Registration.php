<?php
/*
 * Класс Registration записывать и проверять пользователя в БД
 */
class Registration
{

    private $dataUser = [];
    /*
     * Записываем пользователя
     */
    public function insertUser($login, $password)
    {
        $connect = new ConnectDB();
        /* Экранируем данные */
        $loginReal = $connect->getConnect()->real_escape_string($login);
        $passwordReal = $connect->getConnect()->real_escape_string($password);
        $sql = "INSERT INTO users (login, password) VALUES ('$loginReal', '$passwordReal')";

        $result = $connect->getConnect()->query($sql);
        $connect->closeConnect();
        return $result;
    }

    /*
     * Получаем данные пользователя по логину
     */
    public function findUser($param)
    {
        $connect = new ConnectDB();
        /* Экранируем данные */
        $paramReal = $connect->getConnect()->real_escape_string($param);
        $sql = "SELECT * FROM users WHERE login ='$paramReal'";

        $result = $connect->getConnect()->query($sql)->fetch_all()[0];
        /* записываем id */
        $this->dataUser['id'] = $result[0];
        /* записываем логин */
        $this->dataUser['login'] = $result[1];
        /* записываем пароль */
        $this->dataUser['password'] = $result[2];
        $connect->closeConnect();
        return $this->dataUser;
    }

}