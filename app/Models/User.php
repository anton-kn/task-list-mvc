<?php
/*
 * Класс Registration записывать и проверять пользователя в БД
 */
class User extends Model
{

    private $dataUser = [];
    /*
     * Записываем пользователя
     */
    public function insertUser($login, $password)
    {
        /* Защита от XSS */
        $loginSpecial = htmlspecialchars($login, ENT_QUOTES, 'UTF-8');
        $passwordSpecial = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');

        $sql = "INSERT INTO users (login, password) VALUES (?, ?)";

        $stm = $this->connectionDb->prepare($sql);

        $stm->bind_param("ss", $loginSpecial, $passwordSpecial);

        $result = $stm->execute();

        return $result;
    }
    /*
     * Получаем данные пользователя по логину
     */
    public function findUser($login)
    {
        /* Защита от XSS */
        $loginSpecial = htmlspecialchars($login, ENT_QUOTES, 'UTF-8');

        /* Экранируем данные */
        $sql = "SELECT * FROM users WHERE login=?";
        $stm = $this->connectionDb->prepare($sql);
        $stm->bind_param("s", $loginSpecial);
        $stm->execute();
        $stm->bind_result($idResult, $loginResult, $passwordResult, $creatTimeResult);
        $stm->fetch();

        /* записываем id */
        $this->dataUser['id'] = $idResult;
        /* записываем логин */
        $this->dataUser['login'] = $loginResult;
        /* записываем пароль */
        $this->dataUser['password'] = $passwordResult;
        return $this->dataUser;
    }
}