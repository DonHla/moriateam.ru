<!DOCTYPE html>
<html lang="ru">
<head>
  <?php
   $website_title = 'Личный кабинет';
   require 'block/head.php'; ?>
</head>
<body>
<?php require 'block/header.php'; ?>

  <div class="row">
    <?php require 'block/leftmenu.php'; ?>
    <div class="col-md-5 mb-5">
      <h4>Смена пароля</h4>
<form>

        <label for="pass"> Пароль</label>
        <input type="password" name="pass" id="pass" class="form-control">

        <label for="passrepeat"> Повторите пароль </label>
        <input type="password" name="passrepeat" id="passrepeat" class="form-control">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

        <div class="alert alert-danger mt-2" id="errorBlock10"> </div>

        <button type="button" id="change_pass" class="btn btn-warning mt-3 mr-2 mb-3">
          Изменить
        </button>
</form>
    </div>

    <?php require 'block/aside.php'; ?>

    <?php require 'block/footer.php'; ?>

    <script>
    $('#change_pass').click(function () {

      var pass = $('#pass').val();
      var passrepeat = $('#passrepeat').val();

      $.ajax({
        url:'ajax/change_pass.php',
        type: 'POST',
        cache:false,
        data:{'pass': pass,  'passrepeat': passrepeat },
        dataType: 'html',
        success: function(data){
        if(data == 'готово'){
          $('#change_pass').text('Всё готово');
          $('#errorBlock10').hide();
          location.replace("enter.php");
          }
        else {
            $('#errorBlock10').show();
            $('#errorBlock10').text(data);
          }
        }
      });
    });
    </script>

</body>
</html>
