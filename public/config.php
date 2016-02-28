<?php

define('ROOT_PATH', '/'); // корневой путь

define('STYLE_URL', ROOT_PATH . 'style.css'); // файл стилей

define('METHOD', $_SERVER['REQUEST_METHOD']); // HTTP - метод

define('DB_HOST', 'localhost'); // mysql host
define('DB_PORT', '33060'); // порт сервера
define('DB_NAME', 'feedback'); // имя базы данных
define('DB_USER', 'homestead'); // имя пользователя базы данных
define('DB_PASS', 'secret'); // пароль пользователя базы данных