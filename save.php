<?php

/** MySQL database name */
define('DB_NAME', 'email');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Table with emails */
define('DB_EMAIL_TABLE', 'address');

/*******************************/
if (isset($_POST['email'])) {
    //mysql_real_escape_string - Это аццке важно. А то кто-то в поле ввода емейла напишет DROP TABLE; и похерит всю таблицу с адресами
    $email = mysql_real_escape_string($_POST['email']);
}


$db = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
mysql_select_db(DB_NAME, $db);

//Делаем выборку из базы с таким адресом
$result = mysql_query("SELECT * FROM " . DB_EMAIL_TABLE . " WHERE `address` = '{$email}'", $db);

//Сморим: если такого адреса нет - тогда добавить в базу. В противном случае не делает ничего
if ($result && !mysql_fetch_assoc($result)) {
    mysql_query("INSERT INTO " . DB_EMAIL_TABLE . " (address) VALUES ('$email')", $db);
}





