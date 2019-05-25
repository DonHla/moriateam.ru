<!DOCTYPE html>
<html lang="ru">
<head>
  <?php
   $website_title = 'Игры сегодня';
   require 'block/head.php'; ?>
</head>
  <body>

<?php require 'block/header.php'; ?>

<?php
// нужно выводить для игрока, который авторизовался в личном кабинете
require_once 'mysql_connect.php';
// нужно добраться до id_game и передать его кнопке выхода их команды


if ($_COOKIE['position'] == 3) //значит игрок
{
$sql = 'SELECT  t.name_of_team, lop.id_playing1, lop.id_playing2, lop.id_playing3, lop.id_playing4,
t.id_master, g.id_game, t.id_team, g.time_game, g.data_game, g.place_game
FROM `player` p
INNER JOIN `playing` pl ON p.id_player = pl.id_player
INNER JOIN `list_of_playing` lop ON (pl.id_playing = lop.id_playing1 OR  pl.id_playing = lop.id_playing2 OR
pl.id_playing = lop.id_playing3 OR pl.id_playing = lop.id_playing4)
INNER JOIN `team` t ON lop.id_list_of_playing = t.id_list_of_playing
INNER JOIN `game` g ON g.id_team = t.id_team
RIGHT JOIN `master` m ON t.id_master = m.id_master
 WHERE `nick` = :nick AND   g.data_game = :today  AND  g.time_game >= :time1';
 $query = $pdo->prepare($sql);
 $query->execute(['nick'=> $_COOKIE['nickname'], 'today'=> date("d.m.Y"), 'time1'=> date("H:m") ]);

}
else if ($_COOKIE['position'] == 5) //значит мастер
{
 $sql = 'SELECT  t.name_of_team, lop.id_playing1, lop.id_playing2, lop.id_playing3, lop.id_playing4,
 t.id_master, g.id_game, t.id_team, g.time_game, g.data_game, g.place_game
 FROM `player` p
 RIGHT JOIN `master` m ON p.id_player = m.id_player
 INNER JOIN `team` t ON t.id_master = m.id_master
 INNER JOIN `game` g ON t.id_team = g.id_team
 INNER JOIN `list_of_playing` lop ON lop.id_list_of_playing = t.id_list_of_playing
  WHERE `nick` = :nick AND   g.data_game = :today';
  $query = $pdo->prepare($sql);
  $query->execute(['nick'=> $_COOKIE['nickname'], 'today'=> date("d.m.Y")]);

}
else echo 'Ошибка при select!';
?>
<?php require 'block/games.php'?>

<?php
if ($_COOKIE['position'] == 3) //значит игрок
{
echo '*Если здесь нет списка команд, то значит вы не записались сегодня на игру.';
}
else if ($_COOKIE['position'] == 5) //значит мастер
{
echo '*Если здесь нет списка команд, то значит вы не назначили игр на сегодня или никто пока не записался на игру.';
}
else echo 'Ошибка!';
?>



</body>
</html>
