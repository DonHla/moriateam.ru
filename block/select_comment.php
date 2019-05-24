
<?php
echo '<h5> Отзывы:';
 while ($row = $query -> fetch(PDO::FETCH_OBJ) ){
$sql = 'SELECT  p.nick, l.name_of_level_player FROM `comment` c
INNER JOIN `player` p ON c.id_troll = p.id_player
INNER JOIN `level` l ON l.id_level = p.id_level
 WHERE `id_troll` = :id_troll';
 $query1 = $pdo->prepare($sql);
 $query1->execute(['id_troll'=> $row->id_troll]);
 $row1 = $query1 -> fetch(PDO::FETCH_OBJ);

echo '<br>'.$row->text_comment.'  <button type="button" value="'.$row1->nick.'" onclick="getValPl(this.value)"
class="btn btn-outline-success  mt-4">'.$row1->nick.'('.$row1->name_of_level_player.')'.' </button>  <br> ';

}
?>
