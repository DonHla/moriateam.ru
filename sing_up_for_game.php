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

<h5>Свободное время:</h5>
<?php
$sql = 'SELECT dtp.* FROM `player` p
INNER JOIN `master` m ON  m.id_player = p.id_player
INNER JOIN `data_time_place_master` dtp ON  m.id_master = dtp.id_master
WHERE `nick` = :nick AND  dtp.date >= :today AND  dtp.time >= :time1';
$query2 = $pdo->prepare($sql);
$query2->execute(['nick'=> $username, 'today'=> date("d.m.Y"), 'time1'=> date("H:m")]);
while ($row2 = $query2 -> fetch(PDO::FETCH_OBJ)){
  echo '<button type="button" value="'.$row2->time.' '.$row2->date.' '.$row2->place.'" onclick="getValTime(this.value)"
  class="btn btn-success  mt-4">'.$row2->time.' '.$row2->date.' '.$row2->place.' </button>  <br> ';
}
?>
<br>
<?php   require 'block/select_comment.php'; ?>
<br>


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

    // function getValPl(valuePl) {
    //
    //   $.ajax({
    //     url:'ajax/sessionPlayerInf.php',
    //     type: 'POST',
    //     cache:false,
    //     data:{'value' : valuePl},
    //     dataType: 'html',
    //     success: function(data){
    //  if(data === 'replace') {
    //      location.replace("player_prof_outside.php");
    //  }
    //  else {
    //   alert ('Произошла ошибка обработки')
    //  }
    // }
    //  });
    // }



    </script>

</body>
</html>
