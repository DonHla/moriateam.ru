<?php
  $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
  $pass = trim(filter_var($_POST['pass'], FILTER_SANITIZE_STRING));
  $error = '';

  if(strlen($username) <= 3)
  $error = 'Введите имя';
  else if(strlen($pass) <= 3)
  $error = 'Введите пароль';

if ($error != ''){
  echo $error;
  exit();
}

$hash = "elinor";
$pass = md5($pass . $hash);

require_once '../mysql_connect.php';

$sql = 'SELECT `id_player` FROM `player` WHERE `nick` = :nick  && `password` = :pass';
$query = $pdo->prepare($sql);
$query->execute(['nick'=> $username, 'pass' => $pass]);

$user = $query -> fetch(PDO::FETCH_OBJ);// позволяет вытащить только одну запись из бд
if ($user == NULL)
echo 'Такого пользователя не существует';
else {
  setcookie("nickname", $_POST['username'], time() + 3600 * 24 * 30, "/");
  //
//  setcookie('nickname', $username, time()-3600*24*30, "/");
//
  echo 'готово';
}
// header("Location: /test.php");
//Потогм вставим сюда личный кабинет
?>