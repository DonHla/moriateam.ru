<?php

 // если через показываются свои команды, то нужно чтобы кнопки были не активны disabled
 //если подбор приключений,то btn-outline-secondary
 //<div><h5>Название игры: </h5></div>


 if ($rowId->id_playing1 != '')
 {
   $sql = 'SELECT  p.nick, l.name_of_level_player FROM `playing` pl
   INNER JOIN `player` p  ON pl.id_player = p.id_player
   INNER JOIN `level` l ON p.id_level = l.id_level
   WHERE `id_playing` = :id_playing';
   $queryP1 = $pdo->prepare($sql);
   $queryP1->execute(['id_playing'=> $rowId->id_playing1]);
   $rowP1 = $queryP1 -> fetch(PDO::FETCH_OBJ);

   echo '<button  type="button" class="btn btn-secondary  mt-2 mr-3 ml-3"  value="'.$rowP1->nick.'" onclick="getValPl(this.value)"> '.$rowP1->nick.'('.$rowP1->name_of_level_player.')'.' </button>';
 }
 else
 {
     echo '<button  type="button" class="btn btn-secondary  mt-2 mr-2 ml-2" disabled> Требуется рекрут </button>';
 }
 if ($rowId->id_playing2!=''){

       $sql = 'SELECT  p.nick, l.name_of_level_player FROM `playing` pl
       INNER JOIN `player` p  ON pl.id_player = p.id_player
       INNER JOIN `level` l ON p.id_level = l.id_level
       WHERE `id_playing` = :id_playing';
       $queryP2 = $pdo->prepare($sql);
       $queryP2->execute(['id_playing'=> $rowId->id_playing2]);
       $rowP2 = $queryP2 -> fetch(PDO::FETCH_OBJ);

 echo  '<button  type="button" class="btn btn-secondary  mt-2 mr-3 ml-3"  value="'.$rowP2->nick.'" onclick="getValPl(this.value)"> '.$rowP2->nick.'('.$rowP2->name_of_level_player.')'.'</button>';
 }
 else
 {
     echo '<button type="button"  class="btn btn-secondary  mt-2 mr-2 ml-2" disabled> Требуется рекрут </button>';
 }

 if($rowId->id_playing3!=''){

   $sql = 'SELECT  p.nick, l.name_of_level_player FROM `playing` pl
   INNER JOIN `player` p  ON pl.id_player = p.id_player
   INNER JOIN `level` l ON p.id_level = l.id_level
   WHERE `id_playing` = :id_playing';
   $queryP3 = $pdo->prepare($sql);
   $queryP3->execute(['id_playing'=> $rowId->id_playing3]);
   $rowP3 = $queryP3 -> fetch(PDO::FETCH_OBJ);

     echo  '<button type="button"  class="btn btn-secondary  mt-2 mr-3 ml-3"  value="'.$rowP3->nick.'" onclick="getValPl(this.value)"> '.$rowP3->nick.'('.$rowP3->name_of_level_player.')'.'</button>';
 }

 else{
   echo '<button type="button" class="btn btn-secondary  mt-2 mr-2 ml-2" disabled> Требуется рекрут </button>';
 }

 if($rowId->id_playing4!=''){

       $sql = 'SELECT  p.nick, l.name_of_level_player FROM `playing` pl
       INNER JOIN `player` p  ON pl.id_player = p.id_player
       INNER JOIN `level` l ON p.id_level = l.id_level
       WHERE `id_playing` = :id_playing';
       $queryP4 = $pdo->prepare($sql);
       $queryP4->execute(['id_playing'=> $rowId->id_playing4]);
       $rowP4 = $queryP4 -> fetch(PDO::FETCH_OBJ);
       
       echo  '<button type="button" class="btn btn-secondary  mt-2 mr-3 ml-3"   value="'.$rowP4->nick.'" onclick="getValPl(this.value)"> '.$rowP4->nick.'('.$rowP4->name_of_level_player.')'.' </button>';
 }
 else{
   echo '<button type="button"  class="btn btn-secondary  mt-2 mr-2 ml-2" disabled> Требуется рекрут </button>';
 }

 echo '</div> </p>';

?>
