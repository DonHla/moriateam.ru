 <!-- Можно сделать через выпадающий выбор, так будет удобней, но менее функционально -->
 <?php
 session_start();
 ?>
<html lang="ru">
<head>
  <?php
   $website_title = 'Поиск приключений';
   require 'block/head.php'; ?>
</head>
  <body>
<?php require 'block/header.php'; ?>

<div>
 <main >
  <div class="row">
<?php require 'block/leftmenu.php'; ?>
    <div class="col-md-3 mb-1">
      <h4>Поиск приключений</h4>
<form>
<h5>Стиль игры</h5>

 <?php
 require_once 'mysql_connect.php';
 $sql = 'SELECT * FROM `list_of_type_games`';
 $query = $pdo -> query($sql);
 $val_typeofgame = 1;
echo '<label for="typeofgame"> Какие игры хотите проводить? </label>
<select id="typeofgame" name="typeofgame" class="form-control">';
 while ($row = $query -> fetch(PDO::FETCH_OBJ)) {

echo '<option value="'.$val_typeofgame.'">'. $row->name_of_tg .'</option>';
  $val_typeofgame = ++$val_typeofgame;
 }
echo '</select>';
 ?>

</form>

  </div>

    <div class="col-md-3 mb-1">
    <h4>.</h4>
    <form>
<h5>Вселенная</h5>

<?php
  $sql = 'SELECT * FROM `list_universe`';
  $query = $pdo -> query($sql);
  $val_universe = 11;
 echo '<label for="universe"> Какие игры хотите проводить? </label>
 <select id="universe" name="universe" class="form-control">';
  while ($row = $query -> fetch(PDO::FETCH_OBJ)) {

 echo '<option value="'.$val_universe.'">'. $row->name_of_universe .'</option>';
   $val_universe = ++$val_universe;
 }
 echo '</select>';

  ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

  <div class="alert alert-danger mt-2" id="errorBlock4"> </div>


  <button type="button" id="btn_find_master" class="btn btn-warning mt-4" >
    Найти мастеров и комады
  </button>


<?php
$stringOut= '';
$index=1;
foreach ($_SESSION['masterInf'] as  $valueMasterInf) {
echo '<div id="master_count_div" value="'.$valueMasterInf['Ник мастера'].'" >';

foreach ($valueMasterInf as $key => $value) {
$stringOut= $stringOut.' '.$key.': '.$value;

   }

   echo   '<button type="button" id="master_cout'.$index.'" class="btn btn-success mt-4">'.$stringOut.'
     </button> ';
    $stringOut='';
    $index++;
}
 echo '</div>';


?>
</div>
    </form>

<!--  Потом наведём красоту-->
    <?php //require 'block/aside.php'; ?>

    <?php //require 'block/footer.php';?>

   </main>
 </div>


 <script>

 $('#master_count_div').click(function () {

    var sessionValue = document.getElementById('master_count_div').getAttribute('value');
    alert(sessionValue);
 //
 //    $.ajax({
 //
 //      url:'ajax/sessionMasterInf.php',
 //      type: 'POST',
 //      cache:false,
 //      data:{'master_count_div' : sessionValue},
 //      dataType: 'html',
 //      success: function(data){
 //   if(data === 'replace') {
 //        $('#errorBlock4').hide();
 //       location.replace("sing_up_for_game.php");
 //   }
 //   else {
 //     $('#errorBlock4').show();
 //     $('#errorBlock4').text(data);
 //     alert("не работаю");
 //   }
 // }
 //   });
 });


 $('#btn_find_master').click(function () {

  var val_typeofgame = $('#typeofgame').val();
  var val_universe = $('#universe').val();

 $.ajax({
   url:'ajax/seatch.php',
   type: 'POST',
   cache:false,
   data:{'typeofgame' : val_typeofgame, 'universe' : val_universe},
   dataType: 'html',
   success: function(data){
if(data === 'reload') {
   $('#errorBlock4').hide();
    location.reload(); //перезагружаем страницу через JS
}
else {
  $('#errorBlock4').show();
  $('#errorBlock4').text('Ничего не найдено');
}
   }
 });
});

 </script>
</body>
</html>
