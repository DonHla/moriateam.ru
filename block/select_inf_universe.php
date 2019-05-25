
  <?php
  $sql = 'SELECT  tg.name_of_tg, lu.name_of_universe, p.id_position FROM `player` p
  INNER JOIN `master` m ON m.id_player = p.id_player
  INNER JOIN `list_universe` lu ON lu.id_universe = m.id_universe
  INNER JOIN `list_of_type_games` tg ON m.id_ltg = tg.id_ltg
  WHERE `nick` = :nick';
  $query1 = $pdo->prepare($sql);
  $query1->execute(['nick'=> $username]);
  $row1 = $query1 -> fetch(PDO::FETCH_OBJ);

if ($row1->id_position == 5){
  echo '<h5>Стиль: '.$row1->name_of_tg .' </h5> ';
    echo '<h5>Вселенная: '.  $row1->name_of_universe .' </h5> ';
  }
  ?>
