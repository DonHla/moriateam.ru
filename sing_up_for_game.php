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
<?php
 require_once 'mysql_connect.php';
 $username = $_SESSION['masterInfName'];

 $sql = 'SELECT p.*, l.name_of_level_player FROM `player` p
INNER JOIN `level` l ON p.id_level = l.id_level
WHERE `nick` = :nick';
 $query = $pdo->prepare($sql);
 $query->execute(['nick'=> $username]);
 $row = $query -> fetch(PDO::FETCH_OBJ);


$sql = 'SELECT  c.text_comment, c.id_troll FROM `player` p
INNER JOIN `comment` c ON c.id_player = p.id_player
WHERE `nick` = :nick';
$query = $pdo->prepare($sql);
$query->execute(['nick'=> $username]);

$sql = 'SELECT  c.text_comment, c.id_troll FROM `player` p
INNER JOIN `comment` c ON c.id_player = p.id_player
WHERE `nick` = :nick';
$query = $pdo->prepare($sql);
$query->execute(['nick'=> $username]);

?>

<?php require 'block/header.php'; ?>

  <div class="row">
<?php require 'block/leftmenu.php'; ?>
    <div class="col-md-6 mb-5">

      <h4>Информация о мастере и времени игры</h4>
<form>

<h5> Ник мастера : <?=$row->nick?> </h5>
<h5> Уровень : <?=$row->name_of_level_player?> </h5>
<h5> Почта : <?=$row->e_mail?> </h5>
<h5> Характеристика : <?=$row->about_yourself?> </h5>
<h5> Контакты : <?=$row->contact?> </h5>
<h5>Свободное время:</h5>
<?php
$sql = 'SELECT dtp.* FROM `player` p
INNER JOIN `master` m ON  m.id_player = p.id_player
INNER JOIN `data_time_place_master` dtp ON  m.id_master = dtp.id_master
WHERE `nick` = :nick';
$query2 = $pdo->prepare($sql);
$query2->execute(['nick'=> $username]);
while ($row2 = $query2 -> fetch(PDO::FETCH_OBJ)){
  echo '<button type="button" value="'.$row2->time.' '.$row2->date.' '.$row2->place.'" onclick="getVal(this.value)"
  class="btn btn-success  mt-4">'.$row2->time.' '.$row2->date.' '.$row2->place.' </button>  <br> ';
}
?>
<br>
<h5> Отзывы:
<?php while ($row = $query -> fetch(PDO::FETCH_OBJ) ){

$sql = 'SELECT  p.nick, l.name_of_level_player FROM `comment` c
INNER JOIN `player` p ON c.id_troll = p.id_player
INNER JOIN `level` l ON l.id_level = p.id_level
 WHERE `id_troll` = :id_troll';
 $query1 = $pdo->prepare($sql);
 $query1->execute(['id_troll'=> $row->id_troll]);
 $row1 = $query1 -> fetch(PDO::FETCH_OBJ);

echo '<br>'.$row->text_comment.'  <button type="button" value="'.$row1->nick.'" onclick="getVal(this.value)"
class="btn btn-outline-success  mt-4">'.$row1->nick.'('.$row1->name_of_level_player.')'.' </button>  <br> ';

}
?>
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

    function getVal(value) {
      alert(value);
    }

    $('#change_me').click(function () {
      var nick = $('#username').val();
      var email = $('#email').val();
      var character = $('#character').val();
      var contact = $('#contact').val();



      $.ajax({
        url:'ajax/real_me.php',
        type: 'POST',
        cache:false,
        data:{'username' : nick, 'email' : email,'character' : character, 'contact' : contact},
        dataType: 'html',
        success: function(data){
        if(data == 'готово'){
          $('#change_me').text('Всё готово');
          $('#errorBlock3').hide();
          }
        else {
            $('#errorBlock3').show();
            $('#errorBlock3').text(data);
          }
        }
      });
    });
    </script>

</body>
</html>
