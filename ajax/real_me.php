<?php
  $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
  $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
  $character = trim(filter_var($_POST['character'], FILTER_SANITIZE_STRING));
  $contact = trim(filter_var($_POST['contact'], FILTER_SANITIZE_STRING));

  $error='';
  if(strlen($username) <= 3)
  $error = 'Введите имя';
  else if(strlen($email) <= 3)
  $error = 'Введите email';
  else if(strlen($character) <= 3)
 $error = 'ну хотябы пару слов о себе';
  else if(strlen($contact) <= 3)
  $error = 'Введите контакты';

if($error != ''){
echo $error;
exit();
}

require_once '../mysql_connect.php';

$sql = 'SELECT `id_player`, `nick` FROM `player` WHERE `nick` = :nick';
$query = $pdo->prepare($sql);
$query->execute(['nick'=> $username,]);
$user = $query -> fetch(PDO::FETCH_OBJ);// позволяет вытащить только одну запись из бд

if (($user == NULL) || ($user->nick == $_COOKIE['nickname']))
  {

// Типо отправляется запрос админу
echo "Запрос на изменение личных данных отправлен!";
echo "  Изменение личных данных будет проведено в ближайшее время!";
echo ' готово';

}

     // $sql = 'UPDATE `player` SET `nick` = :nick , `e_mail` = :mail, `about_yourself` = :charact, `contact` = :contact WHERE `player`.`id_player` =13';
     // $query = $pdo->prepare($sql);
     // $query->execute(['nick'=>$username, 'mail'=>$email, 'nicharactck'=>$character, 'contact'=>$contact]);
  //  $user = $query -> fetch(PDO::FETCH_OBJ);
  //  $_COOKIE['nickname'] = $user->nick;
  // $sql = 'SELECT `id_player` FROM `player` WHERE `nick` = :nick  && `password` = :pass';
  // $query = $pdo->prepare($sql);
  // $query->execute(['nick'=> $username, 'pass' => $pass]);

else
{
  echo 'Игрок с таким ником уже существует';
  exit();
}
?>
