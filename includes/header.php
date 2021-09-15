<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?php echo $content['title']; ?></title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <meta content="text/html; charset=utf-8">
</head>
<body>
    <div class="font-mono p-8 bg-gray-200 h-screen">
        <?php include_once "public/" .$dditionalView.".php";?>
    </div>
</body>
</html>