<html lang="ru">
<head>
  <?php
   $website_title = 'Составы команд';
   require 'block/head.php'; ?>
</head>
  <body>

<?php require 'block/header.php'; ?>

<?php
// нужно выводить для игрока, который авторизовался в личном кабинете
require_once 'mysql_connect.php';

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

?>


  <div class="row">
<?php require 'block/leftmenu.php'; ?>
 <!-- <img class="col-md-4" src="/img/madam.png" width="300" height="625"> -->
    <div class="col-md-6 mb-5">

  <h4>Составы команд</h4>
<form>
<?php while ($rowId = $query -> fetch(PDO::FETCH_OBJ)){
 require 'block/my_party.php'; 
}
?>

</p>
</form>

</div>

<?php require 'block/aside.php'; ?>

<?php require 'block/footer.php'; ?>

</div>

</body>
</html>
