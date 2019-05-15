<?php

if (!empty($rowId->id_playing1.$rowId->id_playing2.$rowId->id_playing3.$rowId->id_playing4)){
   $sql = 'SELECT p.nick, l.name_of_level_player FROM `master` m
   INNER JOIN `player` p ON p.id_player = m.id_player
   INNER JOIN `level` l ON p.id_level = l.id_level
   WHERE `id_master` = :id_master';
   $queryM = $pdo->prepare($sql);
   $queryM->execute(['id_master'=>($rowId->id_master)]);
   $rowMaster = $queryM -> fetch(PDO::FETCH_OBJ);

   $sql = 'SELECT  p.nick, l.name_of_level_player FROM `playing` pl
   INNER JOIN `player` p  ON pl.id_player = p.id_player
   INNER JOIN `level` l ON p.id_level = l.id_level
   WHERE `id_playing` = :id_playing';
   $queryP1 = $pdo->prepare($sql);
   $queryP1->execute(['id_playing'=> $rowId->id_playing1]);
   $rowP1 = $queryP1 -> fetch(PDO::FETCH_OBJ);

   $sql = 'SELECT  p.nick, l.name_of_level_player FROM `playing` pl
   INNER JOIN `player` p  ON pl.id_player = p.id_player
   INNER JOIN `level` l ON p.id_level = l.id_level
   WHERE `id_playing` = :id_playing';
   $queryP2 = $pdo->prepare($sql);
   $queryP2->execute(['id_playing'=> $rowId->id_playing2]);
   $rowP2 = $queryP2 -> fetch(PDO::FETCH_OBJ);

   $sql = 'SELECT  p.nick, l.name_of_level_player FROM `playing` pl
   INNER JOIN `player` p  ON pl.id_player = p.id_player
   INNER JOIN `level` l ON p.id_level = l.id_level
   WHERE `id_playing` = :id_playing';
   $queryP3 = $pdo->prepare($sql);
   $queryP3->execute(['id_playing'=> $rowId->id_playing3]);
   $rowP3 = $queryP3 -> fetch(PDO::FETCH_OBJ);

   $sql = 'SELECT  p.nick, l.name_of_level_player FROM `playing` pl
   INNER JOIN `player` p  ON pl.id_player = p.id_player
   INNER JOIN `level` l ON p.id_level = l.id_level
   WHERE `id_playing` = :id_playing';
   $queryP4 = $pdo->prepare($sql);
   $queryP4->execute(['id_playing'=> $rowId->id_playing4]);
   $rowP4 = $queryP4 -> fetch(PDO::FETCH_OBJ);
// если через показываются свои команды, то нужно чтобы кнопки были не активны disabled
//если подбор приключений,то btn-outline-secondary
//<div><h5>Название игры: </h5></div>

echo '
<p>
<div><h5>Название команды: '.$rowId->name_of_team.' </h5> </div>
<div><button  id="btn_master" class="btn btn-dark  btn-lg btn-block mt-2">'. $rowMaster->nick.' ( '.$rowMaster->name_of_level_player.' )'.' </button></div>
<p>
<div>';

if ($rowId->id_playing1 != '')
{
  echo '<button  id="btn_player1" class="btn btn-secondary  mt-2 mr-3 ml-3"> '.$rowP1->nick.'('.$rowP1->name_of_level_player.')'.' </button>';
}
else
{
    echo '<button  id="btn_player1" class="btn btn-secondary  mt-2 mr-2 ml-2" disabled> Требуется рекрут </button>';
}
if ($rowId->id_playing2!=''){
echo  '<button  id="btn_player2" class="btn btn-secondary  mt-2 mr-3 ml-3"> '.$rowP2->nick.'('.$rowP2->name_of_level_player.')'.'</button>';
}
else
{
    echo '<button  id="btn_player2" class="btn btn-secondary  mt-2 mr-2 ml-2" disabled> Требуется рекрут </button>';
}

if($rowId->id_playing3!=''){
    echo  '<button  id="btn_player3" class="btn btn-secondary  mt-2 mr-3 ml-3"> '.$rowP3->nick.'('.$rowP3->name_of_level_player.')'.'</button>';
}

else{
  echo '<button  id="btn_player3" class="btn btn-secondary  mt-2 mr-2 ml-2" disabled> Требуется рекрут </button>';
}

if($rowId->id_playing4!=''){
      echo  '<button  id="btn_player4" class="btn btn-secondary  mt-2 mr-3 ml-3"> '.$rowP4->nick.'('.$rowP4->name_of_level_player.')'.' </button>';
}
else{
  echo '<button  id="btn_player4" class="btn btn-secondary  mt-2 mr-2 ml-2" disabled> Требуется рекрут </button>';
}
echo '</div>
</p>
';
}
else{
echo '<div><h5>У вас пока нет команд </h5> </div>';
  }


?>
