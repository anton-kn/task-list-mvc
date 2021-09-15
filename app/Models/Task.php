<?php
/*
 * Класс предназначен для
 * записи, чтения, удаления заданий
 */
class Task
{
    /* метод для выполнения запроса к БД */
    private function connectDataBase($sql){
        $connect = new ConnectDB();
        /* Подготавливаем запрос */
        $result = $connect->getConnect()->query($sql);
        $connect->closeConnect();
        return $result;
    }

    /*  Добавляем задачу */
    public function addTask($nameLogin, $description)
    {
        $user = new Registration();
        /* Получаем id user */
        $userId = $user->findUser($nameLogin);
        /*Статус задачи */
        $status = false;
        $sql = "INSERT INTO tasks (user_id, description, status)
                VALUES ('".(int) $userId['id']."', '".$description."', '" .(int) $status."')";
        /* Подключаемся к БД */
        return self::connectDataBase($sql);
    }
    /* Считываем все задачи */
    public function showTaskAll($nameLogin)
    {
        $user = new Registration();
        /* Получаем id user */
        $userId = $user->findUser($nameLogin);
        $id = $userId['id'];
        $sql = "SELECT * FROM tasks WHERE user_id = $id";
        $result = self::connectDataBase($sql);
        /* Проверяем наличие задач у пользователя, что не выдавать ошибки */
        if($result == false){
            return self::connectDataBase($sql);
        }else {
            return self::connectDataBase($sql)->fetch_all();
        }
    }
    /* Удаляем все данные с таблицы tasks */
    public function deleteAll($nameLogin)
    {
        $user = new Registration();
        $userId = $user->findUser($nameLogin);
        $id = $userId['id'];
        $sql = "DELETE FROM tasks WHERE user_id = $id";
        return self::connectDataBase($sql);
    }

    public function deleteTaskOne($nameLogin, $valueStatus)
    {
        $user = new Registration();
        $userId = $user->findUser($nameLogin);
        $id = $userId['id'];
        $sql = "DELETE FROM tasks WHERE user_id = $id AND id = $valueStatus";
        return self::connectDataBase($sql);
    }

    /* Подтвержаем статус для всех задач - Выполнено */
    public function statusConfirmAll($nameLogin)
    {
        $user = new Registration();
        $userId = $user->findUser($nameLogin);
        $id = $userId['id'];
        $sql = "UPDATE tasks SET status = true WHERE user_id = $id";
        return self::connectDataBase($sql);
    }

    /* Подтвержаем статус для одной задачи - Выполнено  */
    public function statusConfirmOne($nameLogin, $valueStatus)
    {
        $var = (int) $valueStatus;
        $user = new Registration();
        $userId = $user->findUser($nameLogin);
        $id = $userId['id'];
        $sql_1 = "SELECT status FROM tasks WHERE id = $var";
        $result = self::connectDataBase($sql_1);
        if($result == false){
            return self::connectDataBase($sql_1);
        }else {
            /* Получаем значение из столбца status */
            $status = self::connectDataBase($sql_1)->fetch_all();
            /* $status[0][0] - значение status из таблицы tasks */
            if ($status[0][0] == true){
                $sql_2 = "UPDATE tasks SET status = false WHERE user_id = $id AND id = $valueStatus";
            }else{
                $sql_2 = "UPDATE tasks SET status = true WHERE user_id = $id AND id = $valueStatus";
            }
            return self::connectDataBase($sql_2);
        }

    }

}
