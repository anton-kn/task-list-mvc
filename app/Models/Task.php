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
        /*Статус задачи по умолчанию */
        $status = false;

        $user = new User();
        /* Получаем id user */
        $userId = $user->findUser($nameLogin);

        /* Защита от XSS */
        $descriptionSpecial = htmlspecialchars($description, ENT_QUOTES, 'UTF-8');
        /* Защита от SQL-инъекций */
        $sql = "INSERT INTO tasks (user_id, description, status)
                VALUES (?, ?, ?)";
        $stm = $this->db()->prepare($sql);
        $stm->bind_param("isi", $userId['id'], $descriptionSpecial, $status);
        $stm->execute();
    }
    /* Считываем все задачи */
    public function showTaskAll($nameLogin)
    {
        $user = new User();
        /* Получаем id user */
        $userId = $user->findUser($nameLogin);
        $id = $userId['id'];

        $sql = "SELECT * FROM tasks WHERE user_id = $id";
        $result = $this->db()->query($sql);

        /* Проверяем наличие задач у пользователя, чтобы не выдавать ошибки */
        if($result == false){
            return $this->db()->query($sql);
        }else {
            return $this->db()->query($sql)->fetch_all();
        }
    }
    /* Удаляем все данные с таблицы tasks */
    public function deleteAll($nameLogin)
    {
        $user = new User();
        $userId = $user->findUser($nameLogin);
        $id = $userId['id'];
        $sql = "DELETE FROM tasks WHERE user_id = $id";
        return $this->db()->query($sql);
    }

    /* удаляем одну задачу */
    public function deleteTaskOne($nameLogin, $idStatus)
    {
        $user = new User();
        $userId = $user->findUser($nameLogin);
        $id = $userId['id'];

        $sql = "DELETE FROM tasks WHERE user_id = $id AND id = ?";
        $stm = $this->db()->prepare($sql);
        $stm->bind_param("i", $idStatus);
        return $stm->execute();
    }

    /* Подтвержаем статус для всех задач - Выполнено */
    public function statusConfirmAll($nameLogin)
    {
        $user = new User();
        $userId = $user->findUser($nameLogin);
        $id = $userId['id'];
        $sql = "UPDATE tasks SET status = true WHERE user_id = $id";
        return $this->db()->query($sql);
    }

    /* Подтвержаем статус для одной задачи - Выполнено  */
    public function statusConfirmOne($nameLogin, $idStatus)
    {
//        $var = (int) $idStatus;
        $user = new User();
        $userId = $user->findUser($nameLogin); // запрашиваем данные пользователя
        $id = $userId['id'];                   // выбираем id, для поиска статуса о выполненной задаче

        /* Получаем значение id статуса задачи */
        $sql_1 = "SELECT status FROM tasks WHERE id = ?";

        /* Получаем значение status - true или false */
        $stm = $this->db()->prepare($sql_1);
        $stm->bind_param("i", $idStatus);
        $stm->execute();
        $stm->bind_result($statusResult);
        $stm->fetch();
        $stm->close();

        /* Изменяем значение status */
        if ($statusResult == true){
            $sql_2 = 'UPDATE tasks SET status = false WHERE user_id=? AND id=?';
        }else{
            $sql_2 = 'UPDATE tasks SET status = true WHERE user_id=? AND id=?';
        }
        $stm = $this->db()->prepare($sql_2);
//        if( !$stm ){ //если ошибка - убиваем процесс и выводим сообщение об ошибке.
//            die( "SQL Error: {$this->db()->errno} - {$this->db()->error}" );
//        }
        $stm->bind_param('ii', $id, $idStatus);
        $result = $stm->execute();
        $stm->close();
        return $result;
    }

}
