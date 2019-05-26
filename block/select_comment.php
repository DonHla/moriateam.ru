
<?php
echo '<h5> Отзывы:';
 while ($row = $query -> fetch(PDO::FETCH_OBJ) ){
$sql = 'SELECT  p.nick, l.name_of_level_player FROM `comment` c
INNER JOIN `player` p ON c.id_troll = p.id_player
INNER JOIN `level` l ON l.id_level = p.id_level
 WHERE `id_troll` = :id_troll';
 $query1 = $pdo->prepare($sql);
 $query1->execute(['id_troll'=> $row->id_troll]);
 $row1 = $query1 -> fetch(PDO::FETCH_OBJ);

echo '<br>'.$row->text_comment.'  <button type="button" value="'.$row1->nick.'" onclick="getValPl(this.value)"
class="btn btn-outline-success  mt-4">'.$row1->nick.'('.$row1->name_of_level_player.')'.' </button>  <br> ';
}

echo '<br>
</h5>
    <div>
        <label for="comment" > Оставить отзыв о игроке </label>
        <textarea  value= "" name="comment" id="comment" class="form-control"> </textarea>
    <div class="alert alert-danger mt-2" id="errorBlock8"> </div>
        <button type="button" id="btn_sent_comment" class="btn btn-success mt-3 mr-2">
      Отправить
        </button>
    </div>
';
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

  <script>

  $('#btn_sent_comment').click(function () {
    var comment = $('#comment').val();
    var player_inf_name = '<?php echo $_SESSION['playerInfName']; ?>'
    $.ajax({
      url:'ajax/sent_comment.php',
      type: 'POST',
      cache:false,
      data:{'comment' : comment, 'player_inf_name' : player_inf_name},
      dataType: 'html',
      success: function(data){
      if(data == 'готово'){
        $('#errorBlock8').hide();
         location.reload();
        }
      else {
          $('#errorBlock8').show();
          $('#errorBlock8').text(data);
        }
      }
    });
  });

  function getValPl(valuePl) {
var myName = '<?php echo $_COOKIE['nickname']?>';
    $.ajax({
      url:'ajax/sessionPlayerInf.php',
      type: 'POST',
      cache:false,
      data:{'value' : valuePl},
      dataType: 'html',
      success: function(data){
   if(data === 'replace') {
     if (valuePl == myName)
     location.replace("enter.php");
     else
       location.replace("player_prof_outside.php");
   }
   else {
    alert ('Произошла ошибка обработки')
   }
  }
   });
  }
  </script>
