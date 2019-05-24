 <!-- Сделать переход на других игроков. Сделать отправку комментария-->
 <?php session_start();
 ?>
 <!DOCTYPE html>
 <html lang="ru">
 <head>
   <?php
    $website_title = 'Набор команды';
    require 'block/head.php'; ?>
 </head>
 <body>

 <?php require 'block/header.php'; ?>

   <div class="row">
 <?php require 'block/leftmenu.php'; ?>
     <div class="col-md-6 mb-5">

       <h4>Набор команды</h4>
 <form>
   <?php
require_once 'mysql_connect.php';
   $sql = 'SELECT t.id_team, t.name_of_team, lop.id_list_of_playing, lop.id_playing1, lop.id_playing2, lop.id_playing3, lop.id_playing4, m.id_master,
   tg.name_of_tg, lu.name_of_universe, g.id_game
   FROM `game` g
   INNER JOIN `team` t ON t.id_team = g.id_team
   INNER JOIN `master` m ON t.id_master = m.id_master
   INNER JOIN `player` p ON p.id_player = m.id_player
   INNER JOIN `list_universe` lu ON lu.id_universe = m.id_universe
   INNER JOIN `list_of_type_games` tg ON m.id_ltg = tg.id_ltg
   LEFT JOIN `list_of_playing` lop ON lop.id_list_of_playing = t.id_list_of_playing
   LEFT JOIN `playing` pl ON (pl.id_playing = lop.id_playing1 OR pl.id_playing = lop.id_playing2
   OR pl.id_playing = lop.id_playing3 OR pl.id_playing = lop.id_playing4)
   WHERE  `nick` = :nick  AND `time_game`= :time1 AND `data_game`= :date1  AND `place_game`= :place ';
      $query = $pdo->prepare($sql);
     $query->execute(['nick'=> $_SESSION['masterName'], 'time1'=> $_SESSION['time'], 'date1'=> $_SESSION['date'], 'place' => $_SESSION['place']]);
     $rowId = $query -> fetch(PDO::FETCH_OBJ);

echo '<h5> Время: '. $_SESSION['time'] .'</h5>';
echo '<h5> День: '. $_SESSION['date'].'</h5>';
echo '<h5> Место: '. $_SESSION['place'] .'</h5>';

echo '<h5>  Во что играем:   </h5>';
echo '<h6>Стиль: '.$rowId->name_of_tg .' </h6> ';
  echo '<h6>Вселенная: '.  $rowId->name_of_universe .' </h6> ';

 require 'block/my_party_master.php';
     require 'block/my_party.php';

if (empty($rowId))
{

echo '<h5> Вы 1-ый в команде  &#10102 </h5>';
echo '<h5> Скорее записывайтесь  &#10084  </h5>';
  echo '<button type="button" name="btn_sing_up" id="btn_sing_up" class="btn btn-success  mt-2 mr-3 ml-3"> Записаться в команду </button>' ;
}

 else if ($rowP1->nick != $_COOKIE['nickname'] && $rowP2->nick != $_COOKIE['nickname'] && $rowP3->nick != $_COOKIE['nickname'] && $rowP4->nick != $_COOKIE['nickname'] )
{
  echo '<button type="button" name="btn_sing_up" id="btn_sing_up" class="btn btn-success  mt-2 mr-3 ml-3"> Записаться в команду </button>' ;
 echo '<button type="button" name="btn_out_of_team" id="btn_out_of_team" class="btn btn-warning  mt-2 mr-3 ml-3" disabled> Покинуть команду </button>';
}
else {
echo '<button type="button" id="btn_sing_up" class="btn btn-success  mt-2 mr-3 ml-3" disabled> Записаться в команду </button>' ;
 echo '<button type="button" name="btn_out_of_team" id="btn_out_of_team" class="btn btn-warning  mt-2 mr-3 ml-3"> Покинуть команду </button>' ;
 echo'<br> <h10>*Вы уже записаны на эту игру.</h10>';
}
    ?>
     </div>
     <?php require 'block/aside.php'; ?>

     <?php require 'block/footer.php'; ?>
     </div>
 </form>

     </div>

<!--  Добавить переход по людям-->



 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

     <script>


  $('#btn_sing_up').click(function () {

var id_playing1 = '<?php echo $rowId->id_playing1;?>';
var id_playing2 = '<?php echo $rowId->id_playing2;?>';
var id_playing3 = '<?php echo $rowId->id_playing3;?>';
var id_playing4 = '<?php echo $rowId->id_playing4;?>';
var id_team = '<?php echo $rowId->id_team;?>';
var id_list_of_playing = '<?php echo $rowId->id_list_of_playing;?>';
var id_master = '<?php echo $rowId->id_master;?>';

    if(confirm('Хотите записаться на игру?' ))
    {
    $.ajax({
      url:'ajax/sing_up_for_party.php',
      type: 'POST',
      cache:false,
      data:{'id_playing1': id_playing1, 'id_playing2': id_playing2, 'id_playing3': id_playing3, 'id_playing4': id_playing4, 'id_team': id_team, 'id_list_of_playing': id_list_of_playing, 'id_master': id_master},
      dataType: 'html',
      success: function(data){
        if(data === 'reload') {
  alert('Вы успешно записаны на грядущую игру!');
            location.reload();
        }
        else {
         alert ('Произошла ошибка обработки! Перезапустите страницу и попробуйте снова!');
        }
      }
    });
  }
});

$('#btn_out_of_team').click(function () {

  if(confirm('Вы точно хотите покинуть команду?' ))
  {
var id_game = '<?php echo $rowId->id_game;?>';

  $.ajax({
    url:'ajax/out_of_team.php',
    type: 'POST',
    cache:false,
    data:{'id_game': id_game},
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
});


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

     </script>

 </body>
 </html>
