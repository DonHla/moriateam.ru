<!DOCTYPE html>
<html lang="ru">
<head>
  <?php
   $website_title = 'Прошедшие игры';
   require 'block/head.php'; ?>
</head>
  <body>

<?php require 'block/header.php'; ?>

<?php
// нужно выводить для игрока, который авторизовался в личном кабинете

require_once 'mysql_connect.php';

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
 WHERE `nick` = :nick AND   g.data_game <:today';
 $query = $pdo->prepare($sql);
 $query->execute(['nick'=> $_COOKIE['nickname'], 'today'=> date("d.m.Y") ]);

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
  WHERE `nick` = :nick AND   g.data_game < :today';
  $query = $pdo->prepare($sql);
  $query->execute(['nick'=> $_COOKIE['nickname'], 'today'=> date("d.m.Y")]);

}
else echo 'Ошибка при select!';


?>
<?php require 'block/games.php'?>
<?php
echo '*Если здесь нет списка команд, значит у вас не было ни одной игры.';
 ?>


</body>
</html>
