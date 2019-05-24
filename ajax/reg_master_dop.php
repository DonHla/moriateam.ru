<?php
session_start();

$error='';

$time1 =trim(filter_var( $_POST['time1'], FILTER_SANITIZE_STRING));
$date1 =trim(filter_var( $_POST['date1'], FILTER_SANITIZE_STRING));
$place1 =trim(filter_var($_POST['place1'], FILTER_SANITIZE_STRING));
$name_of_team =trim(filter_var($_POST['nameOfTeam'], FILTER_SANITIZE_STRING));

$freeornot = $_POST['freeornot'];
$type_game = $_POST['typeofgame'];
$new_type_game = trim(filter_var($_POST['newTypeGame'], FILTER_SANITIZE_STRING));
$universe = $_POST['universe'];
$new_universe = trim(filter_var($_POST['newUniverse'], FILTER_SANITIZE_STRING));


if(empty($place1))
$error = 'Введите место встречи';

if(strlen($date1)<10)
$error = 'Введите дату';
else if(strlen($date1)>10)
$error = 'Число введено неверно';
else if($date1{2}!="." || $date1{5}!=".")
$error = 'Пожалуйста, соблюдайте формат ввода даты "."';
else if(!is_numeric($date1{0}.$date1{1}.$date1{3}.$date1{4}.$date1{6}.$date1{7}.$date1{8}.$date1{9}))
$error = 'Пожалуйста, соблюдайте формат ввода даты (цифры)';
else if($date1{0}.$date1{1} > 31 || $date1{0}.$date1{1} <= 0 || $date1{3}.$date1{4} > 12  || $date1{3}.$date1{4} <=0
|| $date1{6}.$date1{7}.$date1{8}.$date1{9} < date ( 'Y' ) || ($date1{0}.$date1{1} < date ( 'D' ) && $date1{3}.$date1{4} < date( 'M' )
&&  $date1{6}.$date1{7}.$date1{8}.$date1{9} < date ( 'Y' )) )
$error = 'Всего 31 день, 12 месяцев и назначать встречу в прошлом не стоит, Доктор Кто';
else if ($date1{6}.$date1{7}.$date1{8}.$date1{9} > 2100)
$error='Предчувствуем появление высшего эльфа';



 if(strlen($time1) < 5)
 $error = 'Введите время';
 else if (strlen($time1) > 5)
 $error = 'Время введено неверно';
 else if($time1{2}!=':')
 $error = 'Пожалуйста, соблюдайте формат ввода времени (:)';
 else if(!is_numeric($time1{0}.$time1{1}.$time1{3}.$time1{4}))
 $error = 'Пожалуйста, соблюдайте формат ввода времени (цифры)';
 else if ($time1{0}.$time1{1} > 24 || $time1{3}.$time1{4} > 60)
 $error = 'Всего 24 часа и 60 минут';
// Проверка на уникальность имени команды 
//  $sql = 'SELECT `id_team` FROM `team` WHERE `name_of_team` = :name_of_team';
//  $query = $pdo->prepare($sql);
//  $query->execute(['name_of_team'=> $name_of_team]);
//  $rowName_of_team = $query -> fetch(PDO::FETCH_OBJ);// позволяет вытащить только одну запись из бд
//
//  if ($rowName_of_team != NULL)
// {
//    $error = 'Такая party уже существует! Имя команды должно быть уникальным';
// }

if($error != ''){
echo $error;
exit();
}

require_once '../mysql_connect.php';

$sql = 'SELECT `id_player`, `id_position` FROM `player` WHERE `nick` = :nick';
$query = $pdo->prepare($sql);
$query->execute(['nick'=> $_SESSION['name_player_for_master']]);
$user = $query -> fetch(PDO::FETCH_OBJ);// позволяет вытащить только одну запись из бд

$sql = 'INSERT INTO master (id_player, id_position, free_or_not, id_ltg, id_universe) VALUES (?, ?, ?, ?, ?)';
$query1 = $pdo->prepare($sql);
$query1->execute([$user->id_player, $user->id_position, $freeornot, $type_game, $universe]);

$sql = 'SELECT m.id_master  FROM `player` p
INNER JOIN `master` m ON m.id_player = p.id_player
WHERE `nick` = :nick';
$query2 = $pdo->prepare($sql);
$query2->execute(['nick'=> $_SESSION['name_player_for_master']]);
$rowMasterInf = $query2 -> fetch(PDO::FETCH_OBJ);

$sql = 'INSERT INTO data_time_place_master ( `time`, `date`, `place`, `id_master`) VALUES (?, ?, ?, ?)';
$query3 = $pdo->prepare($sql);
$query3->execute([$time1, $date1, $place1, $rowMasterInf->id_master]);

$sql = 'INSERT INTO `team`  (id_master, name_of_team) VALUES (?, ?)';
$query4 = $pdo->prepare($sql);
$query4->execute([$rowMasterInf->id_master, $name_of_team]);
$id = $pdo->lastInsertId();
//достать только созданное id или заставить ввести название команды
//Чтобы сразу при вводе времени создавалась команда
//Чтобы чтобы потом было куда записываться

// $sql = 'SELECT t.id_team FROM `team` t
// WHERE `id_master` = :id_master AND `name_of_team`= :name_of_team ';
// $query5 = $pdo->prepare($sql);
// $query5->execute(['id_master'=>$rowMasterInf->id_master, 'name_of_team' => $name_of_team  ]);
// $rowIdTeam = $query5 -> fetch(PDO::FETCH_OBJ);

$sql = 'INSERT INTO `game`  (id_team, id_status_game, time_game, data_game, place_game ) VALUES (?, ?, ?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$id, '1', $time1, $date1, $place1]);

//$array = unserialize($string);//Затем из этой строки, можно снова получить массив
// в seatch тогда придётся использовать двумерный массив
//implode('|', array(1, 2, 3)); склеить

    echo 'готово';

?>
