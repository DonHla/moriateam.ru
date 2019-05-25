<?php

$sql = 'SELECT  p.id_position
FROM `player` p
 WHERE `nick` = :nick';
 $query4 = $pdo->prepare($sql);
 $query4->execute(['nick'=> $username]);
 $rowPosition = $query4 -> fetch(PDO::FETCH_OBJ);

if ($rowPosition->id_position == 3) //значит игрок
{
  $sql = 'SELECT  g.id_game
  FROM `player` p
  INNER JOIN `playing` pl ON p.id_player = pl.id_player
  INNER JOIN `list_of_playing` lop ON (pl.id_playing = lop.id_playing1 OR  pl.id_playing = lop.id_playing2 OR
  pl.id_playing = lop.id_playing3 OR pl.id_playing = lop.id_playing4)
  INNER JOIN `team` t ON lop.id_list_of_playing = t.id_list_of_playing
  INNER JOIN `game` g ON g.id_team = t.id_team
   WHERE `nick` = :nick AND   g.data_game < :today';
   $query = $pdo->prepare($sql);
   $query->execute(['nick'=> $username, 'today'=> date("d.m.Y") ]);
   $row_count = $query->rowCount();


  if ($row_count >= 2 && $row_count <= 5)
  {
    $sql = 'UPDATE `player` SET `id_level` = :index_level
    WHERE  `nick` = :nick';
    $query3 = $pdo->prepare($sql);
    $query3->execute(['nick' => $username, 'index_level' => 2]);
  }
  else if ($row_count > 5 && $row_count <= 10)
  {
    $sql = 'UPDATE `player` SET `id_level` = :index_level
    WHERE  `nick` = :nick';
    $query3 = $pdo->prepare($sql);
    $query3->execute(['nick' => $username, 'index_level' => 3]);
  }
  else if ($row_count > 10 && $row_count <= 15)
  {
    $sql = 'UPDATE `player` SET `id_level` = :index_level
    WHERE  `nick` = :nick';
    $query3 = $pdo->prepare($sql);
    $query3->execute(['nick' => $username, 'index_level' => 4]);
  }
  else if ($row_count > 15 && $row_count <= 21)
  {
    $sql = 'UPDATE `player` SET `id_level` = :index_level
    WHERE  `nick` = :nick';
    $query3 = $pdo->prepare($sql);
    $query3->execute(['nick' => $username, 'index_level' => 5]);
  }
}

else if ($rowPosition->id_position == 5) //значит мастер
{
  $sql = 'SELECT  g.id_game
  FROM `player` p
  RIGHT JOIN `master` m ON p.id_player = m.id_player
  INNER JOIN `team` t ON t.id_master = m.id_master
  INNER JOIN `game` g ON t.id_team = g.id_team
   WHERE `nick` = :nick AND   g.data_game < :today';
   $query = $pdo->prepare($sql);
   $query->execute(['nick'=> $username, 'today'=> date("d.m.Y")]);
  $row_count = $query->rowCount();


 if ($row_count >= 2 && $row_count <= 5)
 {
   $sql = 'UPDATE `player` SET `id_level` = :index_level
   WHERE  `nick` = :nick';
   $query3 = $pdo->prepare($sql);
   $query3->execute(['nick' => $username, 'index_level' => 7]);
 }
 else if ($row_count > 5 && $row_count <= 10)
 {
   $sql = 'UPDATE `player` SET `id_level` = :index_level
   WHERE  `nick` = :nick';
   $query3 = $pdo->prepare($sql);
   $query3->execute(['nick' => $username, 'index_level' => 8]);
 }
 else if ($row_count > 10 && $row_count <= 15)
 {
   $sql = 'UPDATE `player` SET `id_level` = :index_level
   WHERE  `nick` = :nick';
   $query3 = $pdo->prepare($sql);
   $query3->execute(['nick' => $username, 'index_level' => 9]);
 }
 else if ($row_count > 15 && $row_count <= 21)
 {
   $sql = 'UPDATE `player` SET `id_level` = :index_level
   WHERE  `nick` = :nick';
   $query3 = $pdo->prepare($sql);
   $query3->execute(['nick' => $username, 'index_level' => 10]);
   }
 }

else echo 'Ошибка';

 ?>
