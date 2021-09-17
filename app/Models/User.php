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

        /* Экранируем данные */
        $loginReal = $this->connectionDb->real_escape_string($loginSpecial);
        $passwordReal = $this->connectionDb->real_escape_string($passwordSpecial);

        $sql = "INSERT INTO users (login, password) VALUES ('$loginReal', '$passwordReal')";
        $result = $this->connectionDb->query($sql);
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
        $loginReal = $this->connectionDb->real_escape_string($loginSpecial);

        $sql = "SELECT * FROM users WHERE login ='$loginReal'";

       // $sql = "SELECT * FROM users WHERE login=?";

       // $stm = $connect->prepare($sql);
       // $stm->bind_param("s", $param);

       // $stm->execute();
       // $stm->error_list;

//        $stm->bind_result($val);
//        $stm->fetch();

        $result = $this->connectionDb->query($sql)->fetch_all()[0];
        /* записываем id */
        $this->dataUser['id'] = $result[0];
        /* записываем логин */
        $this->dataUser['login'] = $result[1];
        /* записываем пароль */
        $this->dataUser['password'] = $result[2];
        return $this->dataUser;
    }
}