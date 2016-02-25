<?php
  require 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Тестовые задания</title>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="<?= STYLE_URL; ?>">
</head>
<body>
<div class="wrapper">
  <div class="content">
    <div class="card">
      <div class="card_header">
        <h2>Шарафиев Ришат НЧИ КФУ</h2><a href="mailto:rishatsharafiev@ya.ru">rishatsharafiev@ya.ru</a>
      </div>
      <div class="card_body">
        <div class="task">
          <h4 class="task_header">Задача 1. Создать форму обратной связи. </h4>
          <a  class="task_link" href="<?= ROOT_PATH . 'feedback.php'; ?>">Посмотреть решение</a><br>
        </div>
        <div class="task">
          <h4 class="task_header">Задача 2. С использованием Ajax написать скрипт для суммирования чисел.</h4>
          <a  class="task_link" href="<?= ROOT_PATH . 'ajax.php'; ?>">Посмотреть решение</a><br>
        </div>
        <div class="task">
          <h4 class="task_header">Задача 3. Сверстать страницу из PSD исходника.</h4>
          <a  class="task_link" href="<?= ROOT_PATH . 'psd.php'; ?>">Посмотреть решение</a><br>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
