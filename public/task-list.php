<div class="inline-block bg-green-100 w-4/5 py-4 px-2 rounded-lg text-2xl">
    <p class="text-center"><?php echo $content['title'];?></p>
</div>

<?php $userLogin = $_SESSION['user']; ?>

<div class="inline-block px-3 py-2 rounded-lg border-2 bg-green-100">
    <p><?php echo "Привет, " . $userLogin; ?></p>
</div>
<div class="inline-block px-3 py-2 rounded-lg border-2 bg-green-100 hover:bg-green-200">
    <a href="/signout">Выйти</a>
</div>

<?php
if (isset($userLogin)): ?>
    <div class="my-2 p-2 bg-green-100 w-4/5 rounded-lg text-1xl">
        <p class="text-center">Список задач</p>
        <p class="text-center text-red-700"><?php echo $content['error'] ?></p>
        <div class="mx-auto w-96">
            <div class="mb-10 border-b-2 border-green-600">
                <form action="/task-list/add-task" method="post">
                    <input class="w-60 h-10 rounded-lg" type="text" name="description" placeholder="Введите задачу">
                    <button class="my-2 p-2 bg-green-200 hover:bg-green-300 rounded-lg" name="add-task">Добавить</button>
                </form>
                <form action="/task-list/control-all" method="post">
                    <button class="my-2 p-2 bg-green-200 hover:bg-green-300 rounded-lg" name="delete-all">Удалить
                        все</button>
                    <button class="my-2 p-2 bg-green-200 hover:bg-green-300 rounded-lg" name="ready-all">Отметить
                        все</button>
                </form>
            </div>

            <?php if(!empty($content['tasks'])): ?>
                <?php foreach ($content['tasks'] as $task): ?>
                    <!-- $task[2] - это содержание задачи description из таблицы tasks -->
                    <!-- $task[4] - это содержание status  из таблицы tasks -->
                    <div class="p-4 border border-gray-900">
                        <p><?php echo $task[2] ?></p>
                        <form action="/task-list/control-one" method="post">
                            <button class="my-2 p-2 bg-green-200 hover:bg-green-300 rounded-lg"
                                    name="delete-task">Удалить</button>
                            <?php if($task[4] == true): ?>
                                <button class="my-2 p-2 bg-green-300 hover:bg-green-400 rounded-lg"
                                        name="ready-task">Выполнено</button>
                            <?php else: ?>
                                <button class="my-2 p-2 bg-red-300 hover:bg-red-400 rounded-lg" name="ready-task">Не
                                    выполнено</button>
                            <?php endif; ?>
                            <input type="checkbox" name="status" value="<?php echo $task[0]?>" <?php echo ($task[4])
                                ? "checked" : false ; ?>>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php endif;?>
        </div>
    </div>
<?php endif;?>

