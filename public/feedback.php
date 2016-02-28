<?php

  require 'config.php';
  require 'util.php';

  if(METHOD == 'POST') {
    $errors = array();
    $name = isset($_POST['name']) && $_POST['name'];
    $phone = isset($_POST['phone']) && $_POST['phone'];

    $name_value = $name ? $_POST['name'] : '';
    $phone_value = $phone ? $_POST['name'] : '';
    $email_value = isset($_POST['name']) ? $_POST['email'] : '';
    $message_value = isset($_POST['phone']) ? $_POST['message'] : '';

    // echo $name . '<br>';
    // echo $phone . '<br>';
    // echo $name_value . '<br>';
    // echo $phone_value . '<br>';
    // echo $email_value . '<br>';
    // echo $message_value . '<br>';
    // exit;

    if( !$name ) {
      array_push($errors, 'Поле имя обязательно!');
    }

    if( !$phone) {
      array_push($errors, 'Поле телефон обязательно!');
    }

    if( $name && $phone ) {
      $message = new Model();
      $message->insert($name_value, $phone_value, $email_value, $message_value);
    }
  }

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
        <h2>Задача 1. Создать форму обратной связи. </h2>
      </div>
      <div class="card_body">
        <form class="feedback-form" method="post" <?= ROOT_PATH . 'feedback.php'; ?>>
          <div class="form_group">
            <label class="form_label block" for="name">Имя: </label>
            <input class="form_input" type="text" name="name" id="name" placeholder="Введите имя">
          </div>
          <div class="form_group">
            <label class="form_label block" for="phone">Телефон: </label>
            <input class="form_input" type="text" name="phone" id="phone" placeholder="Введите телефон">
          </div>
          <div class="form_group">
            <label class="form_label block" for="email">Эл.почта: </label>
            <input class="form_input" type="email" name="email" id="email" placeholder="Введите почту">
          </div>
          <div class="form_group">
            <label class="form_label block" for="message">Сообщение: </label>
            <textarea class="form_area" name="message" id="message" cols="31" rows="6" placeholder="Введите сообщение"></textarea>
          </div>
          <div class="form_group">
            <input class="btn pull-right" type="submit" value="Отправить" id="send">
          </div>
          <div class="clearfix"></div>
          <div class="form_group">
            <div id="error" class="error">
              <?php
                if( isset($errors) ) {
                  foreach ($errors as $value) {
                    echo $value . '<br>';
                  }
                }
              ?>
            </div>
          </div>
        </form>
        <br>
        <table>
          <tr>
            <th>#</th>
            <th>name</th>
            <th>phone</th>
            <th>email</th>
            <th>message</th>
          </tr>
          <?php
            $message = new Model();
            $message_list = $message->find();
            foreach ($message_list as $key => $value) {
              $id = $key + 1;
              $name = $value->name;
              $phone = $value->phone;
              $email = $value->email;
              $message = $value->message;

              echo "<tr>
                <td>". $id ."</td>
                <td>". $name ."</td>
                <td>". $phone ."</td>
                <td>". $email ."</td>
                <td>". $message ."</td>
              </tr>";
            }
          ?>

        </table>
      </div>
    </div>
  </div>
</div>
</body>
</html>
