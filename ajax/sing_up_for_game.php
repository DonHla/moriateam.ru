<?php
$sql = 'SELECT  t.name_of_team, lop.id_playing1, lop.id_playing2, lop.id_playing3, lop.id_playing4,
m.id_master
FROM `player` p
INNER JOIN `playing` pl ON p.id_player = pl.id_player
INNER JOIN `list_of_playing` lop ON (pl.id_playing = lop.id_playing1 OR  pl.id_playing = lop.id_playing2 OR
pl.id_playing = lop.id_playing3 OR pl.id_playing = lop.id_playing4)
INNER JOIN `team` t ON lop.id_list_of_playing = t.id_list_of_playing
INNER JOIN `master` m ON t.id_master = m.id_master
 WHERE `nick` = :nick';

 $query = $pdo->prepare($sql);
 $query->execute(['nick'=> $_COOKIE['nickname']]);
 while ($rowId = $query -> fetch(PDO::FETCH_OBJ)){
  require 'block/my_party.php';
 }
?>
