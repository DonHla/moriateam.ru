<!DOCTYPE html>
<html lang="ru">
<head>
  <?php
   $website_title = 'Письмо для админа';
   require 'block/head.php'; ?>
</head>
<body>
<?php require 'block/header.php'; ?>

<main class="container mt-5">
  <div class="row">
    <div class="col-md-8 mb-5">
      <h4>Книга жалоб и предложений</h4>
<form>
  <br>
  </h5>
      <div>
        <?php
if ($_COOKIE['nickname'] != '') {
echo '  <label for="nameSender"> От кого </label>
  <input type="text" name="nameSender" id="nameSender" class="form-control" value="'.$_COOKIE['nickname'].'"> <br/>';

  require_once 'mysql_connect.php';

  $sql = 'SELECT  p.e_mail FROM `player` p
   WHERE `nick` = :nick ';
   $query = $pdo->prepare($sql);
   $query->execute(['nick' => $_COOKIE['nickname']]);
   $rowEmail = $query -> fetch(PDO::FETCH_OBJ);

   echo '<label for="emailSender"> Ваша почта </label>
   <input type="email" name="emailSender" id="emailSender" class="form-control" value="'.$rowEmail->e_mail.'"> <br/>';

}
else
{
  echo '<label for="nameSender"> От кого </label>
<input type="text" name="nameSender" id="nameSender" class="form-control"> <br/>';
echo '<label for="emailSender"> Ваша почта </label>
<input type="email" name="emailSender" id="emailSender" class="form-control"> <br/>';
}
        ?>
          <label for="text_mail" > Отправить письмо админу </label>
          <textarea  value= "" name="text_mail" id="text_mail" class="form-control"> </textarea>
  <div class="alert alert-danger mt-2" id="errorBlock9"> </div>
          <button type="button" id="btn_send_comment" class="btn btn-success mt-3 mr-2">
        Отправить
          </button>
      </div>
</form>
    </div>

    <?php require 'block/aside.php'; ?>

    <?php require 'block/footer.php'; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <script>
    $('#btn_send_comment').click(function () {


      var nameSender = $('#nameSender').val();
      var emailSender = $('#emailSender').val();
      var text_mail = $('#text_mail').val();

      $.ajax({
        url:'ajax/mail_for_admin.php',
        type: 'POST',
        cache:false,
        data:{'nameSender' : nameSender, 'emailSender' : emailSender, 'text_mail' : text_mail },
        dataType: 'html',
        success: function(data){
        if(data == 'готово'){
           $('#errorBlock9').hide();
          alert("Ваше сообщение отправлено администратору. Ожидайте ответа на почту. Благодарим за сотрудничество!");
        $('#nameSender').val("");
       $('#emailSender').val("");
         $('#text_mail').val("");
          //  location.reload();
          }
        else {
            $('#errorBlock9').show();
            $('#errorBlock9').text(data);
          }
        }
      });
    });
    </script>

</body>
</html>
