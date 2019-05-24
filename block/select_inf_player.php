<?php
$sql = 'SELECT p.*, l.name_of_level_player FROM `player` p
INNER JOIN `level` l ON p.id_level = l.id_level
WHERE `nick` = :nick';
$query = $pdo->prepare($sql);
$query->execute(['nick'=> $username]);
$row = $query -> fetch(PDO::FETCH_OBJ);


$sql = 'SELECT  c.text_comment, c.id_troll FROM `player` p
INNER JOIN `comment` c ON c.id_player = p.id_player
WHERE `nick` = :nick';
$query = $pdo->prepare($sql);
$query->execute(['nick'=> $username]);


echo '<h5> Ник: '.$row->nick.' </h5>
<h5> Уровень: '.$row->name_of_level_player.'  </h5>
<h5> Почта: '.$row->e_mail.'  </h5>
<h5> Характеристика: '.$row->about_yourself.'  </h5>
<h5> Контакты: '.$row->contact.'  </h5>';
?>
