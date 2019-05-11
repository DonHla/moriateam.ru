<?php
session_start();
$type_game = $_POST['typeofgame'];
$universe = $_POST['universe'];
$i = 0;
$arrSess = array();

require_once '../mysql_connect.php';

$sql = 'SELECT p.nick , m.free_or_not ,
m.date_time_master FROM `player` p INNER JOIN `master` m ON m.id_player = p.id_player
WHERE  m.id_ltg = :tg  && m.id_universe = :un ';
$query = $pdo->prepare($sql);
$query->execute(['tg'=> $type_game, 'un' => $universe]);

while ($row = $query -> fetch(PDO::FETCH_OBJ)) {
 $arrSess[$i] = ' Ник мастера: '. $row->nick .'
  Бесплатно или нет: '. $row->free_or_not.'
  Свободное время: '. $row->date_time_master ;
 $i++;
}
 $_SESSION['masterInf'] = $arrSess;

if (!empty( $_SESSION['masterInf']))
{
echo 'reload';
}
?>
