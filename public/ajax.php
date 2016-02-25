<?php

  require 'config.php';
  // require 'util.php';

  if(METHOD == 'POST') {
    if (isset($_POST['json'])) {
      $request_json = json_decode($_POST['json'], true);

      $float = '/^[1-9][0-9]*\.[0-9]+$/';
      $int = '/^[1-9][0-9]*$/';

      $value1 = preg_match($float, $request_json['value1']) || preg_match($int, $request_json['value1']);
      $value2 = preg_match($float, $request_json['value2']) || preg_match($int, $request_json['value2']);

      $errors = array();
      $result = '';

      if (!$value1) {
        array_push($errors, 'Значение 1 не число');
      }

      if (!$value2) {
        array_push($errors, 'Значение 2 не число');
      }

      if ($value1 && $value2) {
        $result = $request_json['value1'] + $request_json['value2'];
      }

      echo json_encode(array(
        'result' => $result,
        'errors' => $errors
      ));
    }
    exit;
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
        <h2>Задача 2. С использованием Ajax написать скрипт для суммирования чисел.</h2>
      </div>
      <div class="card_body">
        <form class="ajax-form">
          <div class="form_group inline">
            <label class="form_label" for="value1">Значение 1: </label>
            <input class="form_input form_input--small" type="text" id="value1">
          </div>
          <div class="form_group inline">
            <label class="form_label" for="value2">Значение 2: </label>
            <input class="form_input form_input--small" type="text" id="value2">
          </div>
          <div class="form_group inline">
            <input class="btn" type="button" value="Сумма" id="send">
          </div>
          <div class="form_group">
            <label class="form_label" for="value2">Сумма: </label>
            <input class="form_input form_input--small" type="text" id="result">
          </div>
          <div class="form_group">
            <div id="error" class="error"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

function bind(func, context) {
  return function() {
    return func.apply(context, arguments);
  };
}

var calc = {
  $sendButton: document.getElementById('send'),
  $result: document.getElementById('result'),
  $error: document.getElementById('error'),
  $value1: document.getElementById('value1'),
  $value2: document.getElementById('value2'),
  url: '<?= ROOT_PATH . 'ajax.php'; ?>',

  sendHandler: function() {
    this.$error.innerHTML = '';

    var xhr = new XMLHttpRequest();
    xhr.open('POST', this.url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = bind(function() {
      if (xhr.readyState != 4) return;

      if (xhr.status != 200) {
        alert(xhr.status + ': ' + xhr.statusText);
      } else {
        var output = JSON.parse(xhr.responseText);
        var result = output['result'];
        var errors = output['errors'];

        this.$result.value = result;
        errors.forEach( bind(function(data) {
          this.$error.innerHTML += data+'; ';
        },this) );
        var errors = output['errors'];

        this.$result.value = output['result'];
      }
    }, this);


    var data = {
      value1: this.$value1.value,
      value2: this.$value2.value
    }

    var jsonData = JSON.stringify(data);

    xhr.send('json=' + jsonData);
  },

  initialiaze: function() {
    this.$sendButton.addEventListener( 'click', bind(this.sendHandler, this) );
  }

};

window.addEventListener( 'load', bind(calc.initialiaze, calc) );

</script>
</body>
</html>
