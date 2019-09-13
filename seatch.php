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
 $sql = 'DELETE FROM `data_time_place_master`
 WHERE  `date`< ?';
 $query2 = $pdo->prepare($sql);
 $query2->execute([date("d.m.Y")]);


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

</form>

  </div>

    <div class="col-md-3 mb-1">
    <h4>.</h4>
    <form>
<h5>Вселенная</h5>

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

  <div class="alert alert-danger mt-2" id="errorBlock4"> </div>


  <button type="button" id="btn_find_master" class="btn btn-warning mt-4" >
    Найти мастеров и комады
  </button>

</script>

<?php
$stringOut= '';
foreach ($_SESSION['masterInf'] as  $valueMasterInf) {
foreach ($valueMasterInf as $key => $value) {
$stringOut= $stringOut.' '.$key.': '.$value;
   }
      echo  '<button type="button" value="'.$valueMasterInf['Ник мастера'].'" onclick="getVal(this.value)"
      class="btn btn-success mt-4">'.$stringOut.' </button>';
    $stringOut='';

}



?>
</div>
    </form>

<!--  Потом наведём красоту-->
    <?php require 'block/aside.php'; ?>

    <?php require 'block/footer.php';?>

   </main>
 </div>


 <script>

   function getVal(value) {

     $.ajax({
       url:'ajax/sessionPlayerInf.php',
       type: 'POST',
       cache:false,
       data:{'value' : value},
       dataType: 'html',
       success: function(data){
    if(data === 'replace') {
         $('#errorBlock4').hide();
        location.replace("sing_up_for_game.php");
    }
    else {
      $('#errorBlock4').show();
      $('#errorBlock4').text(data);
    }
   }
    });
   }


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
