<?php
  $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
  $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
  $masterplayer = trim(filter_var($_POST['masterplayer'], FILTER_SANITIZE_STRING));
  $character = trim(filter_var($_POST['character'], FILTER_SANITIZE_STRING));
  $contact = trim(filter_var($_POST['contact'], FILTER_SANITIZE_STRING));
  $pass = trim(filter_var($_POST['pass'], FILTER_SANITIZE_STRING));

  $error='';
  if(strlen($username) <= 3)
  $error = 'Введите имя';
  else if(strlen($email) <= 3)
  $error = 'Введите email';
  else if(strlen($character) <= 3)
 $error = 'ну хотябы пару слов о себе';
  else if(strlen($contact) <= 3)
  $error = 'Введите контакты';
  else if(strlen($pass) <= 3)
  $error = 'Придумайте пароль';

if($error != ''){
echo $error;
exit();
}

$hash = "elinor";
$pass = md5($pass . $hash);

require_once '../mysql_connect.php';

$sql = 'SELECT `id_player` FROM `player` WHERE `nick` = :nick';
$query = $pdo->prepare($sql);
$query->execute(['nick'=> $username]);

$user = $query -> fetch(PDO::FETCH_OBJ);// позволяет вытащить только одну запись из бд
if ($user == NULL)
{
     $sql = 'INSERT INTO player (nick, password, e_mail, about_yourself, contact, id_level, id_position) VALUES (?, ?, ?, ?, ?, ?, ?)';
     $query = $pdo->prepare($sql);

    if ($masterplayer == "player")
    $query->execute([$username, $pass, $email, $character, $contact, '1','3']);
    else if($masterplayer == "master")
    $query->execute([$username, $pass, $email, $character, $contact, '5','2']);
    else echo ('Ошибка!');

    echo 'готово';
}
else {
 echo 'Игрок с таким ником уже существует';
  exit();
}

?>