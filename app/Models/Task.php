<?php
/*
 * Класс предназначен для
 * записи, чтения, удаления заданий
 */
class Task extends Model
{
    /*  Добавляем задачу */
    public function addTask($nameLogin, $description)
    {
        $user = new User();
        /* Получаем id user */
        $userId = $user->findUser($nameLogin);

        /*Статус задачи по умолчанию */
        $status = false;

        /* Защита от XSS */
        $descriptionSpecial = htmlspecialchars($description, ENT_QUOTES, 'UTF-8');
        /* Экранируем данные */
        $descriptionReal = $this->connectionDb->real_escape_string($descriptionSpecial);

        $sql = "INSERT INTO tasks (user_id, description, status)
                VALUES ('".(int) $userId['id']."', '".$descriptionReal."', '" . (boolean)$status."')";
        $result = $this->connectionDb->query($sql);
        return $result;
    }
    /* Считываем все задачи */
    public function showTaskAll($nameLogin)
    {
        $user = new User();
        /* Получаем id user */
        $userId = $user->findUser($nameLogin);
        $id = $userId['id'];

        $sql = "SELECT * FROM tasks WHERE user_id = $id";
        $result = $this->connectionDb->query($sql);

        /* Проверяем наличие задач у пользователя, чтобы не выдавать ошибки */
        if($result == false){
            return $this->connectionDb->query($sql);
        }else {
            return $this->connectionDb->query($sql)->fetch_all();
        }
    }
    /* Удаляем все данные с таблицы tasks */
    public function deleteAll($nameLogin)
    {
        $user = new User();
        $userId = $user->findUser($nameLogin);
        $id = $userId['id'];
        $sql = "DELETE FROM tasks WHERE user_id = $id";
        return $this->connectionDb->query($sql);
    }

    /* удаляем одну задачу */
    public function deleteTaskOne($nameLogin, $valueStatus)
    {
        $user = new User();
        $userId = $user->findUser($nameLogin);
        $id = $userId['id'];
        $sql = "DELETE FROM tasks WHERE user_id = $id AND id = $valueStatus";
        return $this->connectionDb->query($sql);
    }

    /* Подтвержаем статус для всех задач - Выполнено */
    public function statusConfirmAll($nameLogin)
    {
        $user = new User();
        $userId = $user->findUser($nameLogin);
        $id = $userId['id'];
        $sql = "UPDATE tasks SET status = true WHERE user_id = $id";
        return $this->connectionDb->query($sql);
    }

    /* Подтвержаем статус для одной задачи - Выполнено  */
    public function statusConfirmOne($nameLogin, $valueStatus)
    {
        $var = (int) $valueStatus;
        $user = new User();
        $userId = $user->findUser($nameLogin); // запрашиваем данные пользователя
        $id = $userId['id'];                   // выбираем id, для поиска статуса о выполненной задаче

        $sql_1 = "SELECT status FROM tasks WHERE id = $valueStatus";
        $result = $this->connectionDb->query($sql_1);

        if($result == false){
            return $this->connectionDb->query($sql_1);
        }else {
            /* Получаем значение из столбца status */
            $status = $this->connectionDb->query($sql_1)->fetch_all();
            /* $status[0][0] - значение status из таблицы tasks */
            if ($status[0][0] == true){
                $sql_2 = "UPDATE tasks SET status = false WHERE user_id = $id AND id = $valueStatus";
            }else{
                $sql_2 = "UPDATE tasks SET status = true WHERE user_id = $id AND id = $valueStatus";
            }
            return $this->connectionDb->query($sql_2);
        }

    }

}
