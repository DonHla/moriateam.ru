<!DOCTYPE html>
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
// нужно добраться до id_game и передать его кнопке выхода их команды


if ($_COOKIE['position'] == 3) //значит игрок
{
$sql = 'SELECT  t.name_of_team, lop.id_playing1, lop.id_playing2, lop.id_playing3, lop.id_playing4,
t.id_master, g.id_game, t.id_team
FROM `player` p
INNER JOIN `playing` pl ON p.id_player = pl.id_player
INNER JOIN `list_of_playing` lop ON (pl.id_playing = lop.id_playing1 OR  pl.id_playing = lop.id_playing2 OR
pl.id_playing = lop.id_playing3 OR pl.id_playing = lop.id_playing4)
INNER JOIN `team` t ON lop.id_list_of_playing = t.id_list_of_playing
INNER JOIN `game` g ON g.id_team = t.id_team
RIGHT JOIN `master` m ON t.id_master = m.id_master
 WHERE `nick` = :nick';
 $query = $pdo->prepare($sql);
 $query->execute(['nick'=> $_COOKIE['nickname']]);

}
else if ($_COOKIE['position'] == 5) //значит мастер
{
 $sql = 'SELECT  t.name_of_team, lop.id_playing1, lop.id_playing2, lop.id_playing3, lop.id_playing4,
 t.id_master, g.id_game, t.id_team
 FROM `player` p
 RIGHT JOIN `master` m ON p.id_player = m.id_player
 INNER JOIN `team` t ON t.id_master = m.id_master
 INNER JOIN `game` g ON t.id_team = g.id_team
 INNER JOIN `list_of_playing` lop ON lop.id_list_of_playing = t.id_list_of_playing
  WHERE `nick` = :nick';
  $query = $pdo->prepare($sql);
  $query->execute(['nick'=> $_COOKIE['nickname']]);

}
else echo 'Ошибка при select!';

?>

 <!-- сделать вывод команд и для мастеров -->

  <div class="row">
<?php require 'block/leftmenu.php'; ?>
 <!-- <img class="col-md-4" src="/img/madam.png" width="300" height="625"> -->
    <div class="col-md-6 mb-5">

  <h4>Составы команд</h4>
<form>
<?php while ($rowId = $query -> fetch(PDO::FETCH_OBJ)){
if (!empty($rowId->id_master.$rowId->id_playing1.$rowId->id_playing2.$rowId->id_playing3.$rowId->id_playing4)){
 require 'block/my_party_master.php';
 require 'block/my_party.php';
}
else{
echo '<div><h5>У вас пока нет команд </h5> </div>';
  }

 if ($_COOKIE['position'] == 3) //значит игрок
 {

   echo '<button type="button" class="btn btn-warning  mt-3 mr-3 ml-3 id="out_of_team" value="'.$rowId->id_game.'" onclick="getValOut(this.value) "
   > Покинуть команду </button>';
  echo '<br>';

 }
 else if ($_COOKIE['position'] == 5) //значит мастер
 {

   $sql = ' SELECT t.name_of_team FROM `team` t
   WHERE  `id_team` = ?';
   $query1 = $pdo->prepare($sql);
   $query1->execute([ $rowId->id_team]);
   $rowNameOfTeam = $query1 -> fetch(PDO::FETCH_OBJ);

  if ($rowNameOfTeam->name_of_team == 'КОМАНДА РАСПУЩЕНА МАСТЕРОМ (ИГРА ОТМЕНЯЕТСЯ). В СКОРОМ ВРЕМЕНИ БУДЕТ УДАЛЕНА ИЗ СПИСКА АДМИНИСТРАТОРОМ!'){

    echo '<button type="button" id="btn_sing_up" class="btn btn-success  mt-2 mr-3 ml-3" value="'.$rowId->id_team.'" onclick="getValUp(this.value)"> Восстановить команду </button>' ;
    echo '<button type="button" class="btn btn-warning  mt-2 mr-3 ml-3 id="out_of_team" value="'.$rowId->id_game.'" onclick="getValOut(this.value) "
    disabled> Покинуть команду </button>';

   echo '<br>
   <br>
   <label for="name_of_team"> Новое название команды </label>
    <input type="text" name="name_of_team" id="name_of_team" class="form-control">';

    echo '    <div class="alert alert-danger mt-2" id="errorBlock6"> </div>';
  }
  else{

     echo '<button type="button" id="btn_sing_up" class="btn btn-success  mt-2 mr-3 ml-3"  value="'.$rowId->id_team.'" onclick="getValUp(this.value)" disabled> Восстановить команду </button>' ;
     echo '<button type="button" class="btn btn-warning  mt-2 mr-3 ml-3 id="out_of_team" value="'.$rowId->id_game.'" onclick="getValOut(this.value) "
     > Покинуть команду </button>';
   }
  echo '<br>';

 }

 else echo 'Ошибка!';

}
?>

</p>
</form>

</div>


<?php require 'block/aside.php'; ?>

<?php require 'block/footer.php'; ?>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <script>

    function getValPl(valuePl) {

      $.ajax({
        url:'ajax/sessionPlayerInf.php',
        type: 'POST',
        cache:false,
        data:{'value' : valuePl},
        dataType: 'html',
        success: function(data){
     if(data === 'replace') {
         location.replace("player_prof_outside.php");
     }
     else {
      alert ('Произошла ошибка обработки')
     }
    }
     });
    }

    function getValOut(valueOut) {
// сюда перебрасывает team
// из tiam можно будет достать всё остальное
var position = <?php echo $_COOKIE['position'];?>;

if (position == 3){

if(confirm('Вы точно хотите покинуть команду?' ))
{
$.ajax({
  url:'ajax/out_of_team.php',
  type: 'POST',
  cache:false,
  data:{'id_game': valueOut,},
  dataType: 'html',
  success: function(data){
    if(data === 'reload') {
alert('Вы покинули команду!');
        location.reload();
    }
    else {
      alert (data);
     alert ('Произошла ошибка обработки! Перезапустите страницу и попробуйте снова!');
    }
  }
});
}
}
else if (position == 5){
if(confirm('Вы точно хотите распустить команду и отменить игру?')){
if(confirm('Точно-точно?')){
$.ajax({
  url:'ajax/out_of_team.php',
  type: 'POST',
  cache:false,
  data:{'id_game': valueOut,},
  dataType: 'html',
  success: function(data){
    if(data === 'reload') {
alert('Вы покинули команду и отменили игру!');
        location.reload();
    }
    else {
      alert (data);
     alert ('Произошла ошибка обработки! Перезапустите страницу и попробуйте снова!');
    }
  }
});
}
}
}
else alert('Ошибка position в ajax');
}



  function getValUp(valueUp) {

var id_team = valueUp;
var name_of_team = $('#name_of_team').val();

//почему-то пустой team нужно посмотреть почему

  if(confirm('Хотите снова созвать данную команду?' ))
  {
  $.ajax({
    url:'ajax/sing_up_for_party_master.php',
    type: 'POST',
    cache:false,
    data:{'id_team': id_team, 'name_of_team': name_of_team},
    dataType: 'html',
    success: function(data){
      if(data === 'reload') {
          $('#errorBlock6').hide();
alert('Вы успешно восстановили отряд!');
          location.reload();
      }
      else {
        alert(data);
            $('#errorBlock6').show();
            $('#errorBlock6').text(data);
       //alert ('Произошла ошибка обработки! Перезапустите страницу и попробуйте снова!');
      }
    }
  });
}
}


    </script>
</body>
</html>
