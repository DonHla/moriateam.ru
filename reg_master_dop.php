<!DOCTYPE html>
<html lang="ru">
<head>
  <?php
   $website_title = 'Дополнение для мастера';
   require 'block/head.php'; ?>
</head>
<body>
<?php require 'block/header.php'; ?>

<main class="container mt-5">
  <div class="row">
    <div class="col-md-8 mb-5">
      <h4>Форма регисрации</h4>
<form>


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


        <label for="freeornot"> Берёте ли вы плату? </label>
        <select id="freeornot" name="freeornot" class="form-control">
                     <option value="Да">Да</option>
                     <option value="Нет">Нет</option>
        </select>

        <?php
        require_once 'mysql_connect.php';
        $sql = 'SELECT * FROM `list_of_type_games`';
        $query = $pdo -> query($sql);
       echo '<label for="typeofgame"> Какие игры хотите проводить? </label>
       <select id="typeofgame" name="typeofgame" class="form-control">';
        while ($row = $query -> fetch(PDO::FETCH_OBJ)) {
       $val_typeofgame = $row->id_ltg;
       echo '<option value="'.$val_typeofgame.'">'. $row->name_of_tg .'</option>';
        }
       echo '</select>';
        ?>

        <?php
          $sql = 'SELECT * FROM `list_universe`';
          $query = $pdo -> query($sql);
         echo '<label for="universe"> Какие игры хотите проводить? </label>
         <select id="universe" name="universe" class="form-control">';
          while ($row = $query -> fetch(PDO::FETCH_OBJ)) {
        $val_universe = $row->id_universe;
         echo '<option value="'.$val_universe.'">'. $row->name_of_universe .'</option>';
         }
         echo '</select>';
          ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

        <div class="alert alert-danger mt-2" id="errorBlock5"> </div>

        <button type="button" id="reg_master" class="btn btn-success mt-3">
          Зарегистрироваться как мастер
        </button>

  <a class="btn btn-warning mt-3 mr-2 ml-2" href="/mail_for_admin.php"> Предложить свой стиль игры или вселенную</a>

</form>
    </div>

    <?php require 'block/aside.php'; ?>

    <?php require 'block/footer.php'; ?>

    <script>
    $('#reg_master').click(function () {

      var time1 = $('#time1').val();
      var date1 = $('#date1').val();
      var place1 = $('#place1').val();
      var nameOfTeam = $('#nameOfTeam').val();
      var freeornot = $('#freeornot').val();
      var typeofgame = $('#typeofgame').val();
      var universe = $('#universe').val();

      $.ajax({
        url:'ajax/reg_master_dop.php',
        type: 'POST',
        cache:false,
        data:{'time1' : time1, 'date1' : date1, 'place1' : place1, 'nameOfTeam' : nameOfTeam, 'freeornot' : freeornot, 'typeofgame' : typeofgame, 'universe': universe},
        dataType: 'html',
        success: function(data){
        if(data == 'готовоготово'){
          $('#reg_master').text('Всё готово');
          $('#errorBlock5').hide();
          location.replace("enter.php");
          }
        else {
            $('#errorBlock5').show();
            $('#errorBlock5').text(data);
          }
        }
      });
    });
    </script>

</body>
</html>
