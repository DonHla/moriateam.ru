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

        <form class="my-form">
            <div class="form-group">
                <label for="password"> Пароль </label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group">
                <a href="#" onclick="return false" id="s-h-pass">Показать пароль</a>
            </div>
        </form>

        <form class="my-form">
            <div class="form-group">
              <label for="passrepeat"> Повторите пароль </label>
              <input type="password" name="passrepeat" id="passrepeat" class="form-control">
            </div>
            <div class="form-group">
                <a href="#" onclick="return false" id="s-h-pass-repeat">Показать повтор пароля</a>
            </div>
        </form>

        <div class="alert alert-danger mt-2" id="errorBlock10"> </div>

        <button type="button" id="change_pass" class="btn btn-warning mt-3 mr-2 mb-3">
          Изменить
        </button>
</form>
    </div>

    <?php require 'block/aside.php'; ?>

    <?php require 'block/footer.php'; ?>

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

    <script>
        $( document ).ready(function() {
            $('#s-h-pass').click(function(){
                var type = $('#password').attr('type') == "text" ? "password" : 'text',
                 c = $(this).text() == "Скрыть пароль" ? "Показать пароль" : "Скрыть пароль";
                $(this).text(c);
                $('#password').prop('type', type);
            });

            $('#s-h-pass-repeat').click(function(){
                var type = $('#passrepeat').attr('type') == "text" ? "password" : 'text',
                 c = $(this).text() == "Скрыть повтор пароля" ? "Показать повтор пароля" : "Скрыть повтор пароля";
                $(this).text(c);
                $('#passrepeat').prop('type', type);
            });
        });
    </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <script>
    $('#change_pass').click(function () {

      var pass = $('#password').val();
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
