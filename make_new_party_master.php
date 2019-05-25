<!DOCTYPE html>
<html lang="ru">
<head>
  <?php
   $website_title = 'Создание новых команд';
   require 'block/head.php'; ?>
</head>
<body>
<?php require 'block/header.php'; ?>

<!-- <main class="container mt-5"> -->
  <div class="row">
    <?php  require 'block/leftmenu.php'; ?>
    <div class="col-md-6 mb-5">
      <h4>Назначение дня новой игры</h4>
<form>
<h5><strong>Уже назначенные</strong></h5>
<?php

require_once 'mysql_connect.php';

$sql = 'SELECT g.time_game, g.data_game, g.place_game, t.name_of_team FROM `player` p
INNER JOIN `master` m ON m.id_player = p.id_player
INNER JOIN `team` t ON t.id_master = m.id_master
INNER JOIN `game` g ON g.id_team = t.id_team
WHERE `nick` = :nick';
$query = $pdo->prepare($sql);
$query->execute(['nick'=> $_COOKIE['nickname']]);
while ($rowInfGame = $query -> fetch(PDO::FETCH_OBJ))
{
  echo'Название команды: '.$rowInfGame->name_of_team.',    Время: '.$rowInfGame->time_game.',    Дата: '.$rowInfGame->data_game.',    Место: '.$rowInfGame->place_game.'.';
echo '<br>';
}
?>
 <br>
<h5><strong>Назначить ещё</strong></h5>
        <label for="time1"> Введите время, дату и числа в которых вам удобно собирать игроков на ближайшие игры
        (формат время: HH:MM, день: DD.MM.YYYY). В личном кабинете Вы сможете назначить больше дат игр.
        </label>
        <label for="time1"> Время</label>
        <input type="text" name="time1" id="time1" class="form-control"> <br/>
        <label for="date1"> Дата</label>
        <input type="text" name="date1" id="date1" class="form-control"> <br/>
        <label for="place1"> Место встречи</label>
        <input type="text" name="place1" id="place1" class="form-control"> <br/>
        <label for="nameOfTeam"> Название команды (соответственно название игры) </label>
        <input type="text" name="nameOfTeam" id="nameOfTeam" class="form-control"> <br/>
*Если назначаете время нескольких игр в один день, то постарайтесь расчитать так, чтобы не произошла накладка.
<br>
        <div class="alert alert-danger mt-2" id="errorBlock7"> </div>

        <button type="button" id="time_plus_master"  name="time_plus_master" class="btn btn-success mt-3">
          Добавить время
        </button>

</form>
    </div>

    <?php require 'block/aside.php'; ?>

    <?php require 'block/footer.php'; ?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <script>

    $('#time_plus_master').click(function () {

      var time1 = $('#time1').val();
      var date1 = $('#date1').val();
      var place1 = $('#place1').val();
      var nameOfTeam = $('#nameOfTeam').val();


      $.ajax({
        url:'ajax/reg_master_dop_time.php',
        type: 'POST',
        cache:false,
        data:{'time1' : time1, 'date1' : date1, 'place1' : place1, 'nameOfTeam' : nameOfTeam },
        dataType: 'html',
        success: function(data){
        if(data == 'готово'){
          $('#errorBlock7').hide();
           $('#time1').val("");
          $('#date1').val("");
          $('#place1').val("");
         $('#nameOfTeam').val("");
        location.reload();
          }
        else {
            $('#errorBlock7').show();
            $('#errorBlock7').text(data);
          }
        }
      });
    });
    </script>

</body>
</html>
