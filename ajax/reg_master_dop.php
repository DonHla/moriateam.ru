<?php
session_start();

$error='';

$freeornot = $_POST['freeornot'];
$type_game = $_POST['typeofgame'];
$universe = $_POST['universe'];


require_once '../mysql_connect.php';

$sql = 'SELECT `id_player`, `id_position` FROM `player` WHERE `nick` = :nick';
$query = $pdo->prepare($sql);
if($_COOKIE['nickname'] == '')
$query->execute(['nick'=> $_SESSION['name_player_for_master']]);
else
$query->execute(['nick'=>$_COOKIE['nickname']]);
$user = $query -> fetch(PDO::FETCH_OBJ);// позволяет вытащить только одну запись из бд

$sql = 'INSERT INTO master (id_player, id_position, free_or_not, id_ltg, id_universe) VALUES (?, ?, ?, ?, ?)';
$query1 = $pdo->prepare($sql);
$query1->execute([$user->id_player, $user->id_position, $freeornot, $type_game, $universe]);

require 'reg_master_dop_time.php';

    echo 'готово';

?>
