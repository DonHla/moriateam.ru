<!-- Сделать переход на других игроков. Сделать отправку комментария-->
<?php session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <?php
   $website_title = 'Информация о мастере и времени игры';
   require 'block/head.php'; ?>
</head>
<body>

<?php require 'block/header.php'; ?>

  <div class="row">
<?php require 'block/leftmenu.php'; ?>
    <div class="col-md-6 mb-5">

      <h4>Информация о мастере и времени игры</h4>
<form>
  <?php
   require_once 'mysql_connect.php';
   $username = $_SESSION['playerInfName'];
  require 'block/select_inf_player.php';
  ?>

  <?php
  $sql = 'SELECT  tg.name_of_tg, lu.name_of_universe FROM `player` p
  INNER JOIN `master` m ON m.id_player = p.id_player
  INNER JOIN `list_universe` lu ON lu.id_universe = m.id_universe
  INNER JOIN `list_of_type_games` tg ON m.id_ltg = tg.id_ltg
  WHERE `nick` = :nick';
  $query1 = $pdo->prepare($sql);
  $query1->execute(['nick'=> $username]);
  $row1 = $query1 -> fetch(PDO::FETCH_OBJ);

  echo '<h5>Стиль: '.$row1->name_of_tg .' </h5> ';
    echo '<h5>Вселенная: '.  $row1->name_of_universe .' </h5> ';
  ?>
<h5>Свободное время:</h5>
<?php
$sql = 'SELECT dtp.* FROM `player` p
INNER JOIN `master` m ON  m.id_player = p.id_player
INNER JOIN `data_time_place_master` dtp ON  m.id_master = dtp.id_master
WHERE `nick` = :nick';
$query2 = $pdo->prepare($sql);
$query2->execute(['nick'=> $username]);
while ($row2 = $query2 -> fetch(PDO::FETCH_OBJ)){
  echo '<button type="button" value="'.$row2->time.' '.$row2->date.' '.$row2->place.'" onclick="getValTime(this.value)"
  class="btn btn-success  mt-4">'.$row2->time.' '.$row2->date.' '.$row2->place.' </button>  <br> ';
}
?>
<br>
<?php   require 'block/select_comment.php'; ?>
<br>
</h5>
    <div>
        <label for="comment" > Оставить отзыв о мастере </label>
        <textarea  value= "" name="comment" id="comment" class="form-control"> </textarea>
        <button type="button" id="" class="btn btn-success mt-3 mr-2">
      Отправить
        </button>

    </div>

    </div>
</form>
<?php require 'block/aside.php'; ?>

<?php require 'block/footer.php'; ?>
    </div>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <script>

    function getValTime(valueTime) {
      var arr = valueTime.split(' ');
      var place = '';
for (var i=2; i< arr.length; i++)
{
   place = place + arr[i] + ' ';
}
      var masterName = '<?php echo $username;?>';

        $.ajax({
          url:'ajax/sessionSingUp.php',
          type: 'POST',
          cache:false,
          data:{'masterName' : masterName, 'time': arr[0] , 'date' : arr[1], 'place' : place },
          dataType: 'html',
          success: function(data){
       if(data === 'replace') {
           location.replace("sing_up_for_party.php");
       }
       else {
        alert ('Произошла ошибка обработки')
       }
      }
       });


    }

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
