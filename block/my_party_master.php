<?php
$sql = 'SELECT p.nick, l.name_of_level_player FROM `master` m
INNER JOIN `player` p ON p.id_player = m.id_player
INNER JOIN `level` l ON p.id_level = l.id_level
WHERE `id_master` = :id_master';
$queryM = $pdo->prepare($sql);
$queryM->execute(['id_master'=>($rowId->id_master)]);
$rowMaster = $queryM -> fetch(PDO::FETCH_OBJ);

echo '
<p>
<div><h5>Название команды: '.$rowId->name_of_team.' </h5> </div>
<div><button  type="button" class="btn btn-dark  btn-lg btn-block mt-2"  value="'.$rowMaster->nick.'" onclick="getValPl(this.value)">'. $rowMaster->nick.' ( '.$rowMaster->name_of_level_player.' )'.' </button></div>
<p>
<div>';

?>
