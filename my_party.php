<html lang="ru">
<head>
  <?php
   $website_title = 'Составы команд';
   require 'block/head.php'; ?>
</head>
  <body>

<?php require 'block/header.php'; ?>



  <div class="row">
<?php require 'block/leftmenu.php'; ?>
 <!-- <img class="col-md-4" src="/img/madam.png" width="300" height="625"> -->
    <div class="col-md-6 mb-5">

  <h4>Составы команд</h4>
<form>
<p>
<div><h5>Название команды:</h5> </div>
<div><h5>Название игры: </h5></div>
<div><button  id="btn_master" class="btn btn-dark  btn-lg btn-block mt-2"> Пока имя мастера </button></div>
<p>
<div>
  <button  id="btn_player1" class="btn btn-secondary  mt-2 mr-4 ml-4"> Имя игрока1 </button>
    <button  id="btn_player2" class="btn btn-secondary  mt-2 mr-4 ml-4"> Имя игрока2 </button>
      <button  id="btn_player3" class="btn btn-secondary  mt-2 mr-4 ml-4"> Имя игрока3 </button>
        <button  id="btn_player4" class="btn btn-secondary  mt-2 mr-4 ml-4"> Имя игрока4 </button>
</div>

</p>
<!-- Если место в команде пустое сделать стиль default -->

<!--  -->

</p>
</form>

</div>

<?php require 'block/aside.php'; ?>

<?php require 'block/footer.php'; ?>

</div>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> -->

<!-- <script> -->
<!--
//$('#exit_btn').click(function () {
//   $.ajax({
//     url:'ajax/exit.php',
//     type:'POST',
//     cache:false,
//     data:{},
//     dataType: 'html',
//     success: function(data){
//         document.location.reload(true);
//     }
//   });
// });
//
// $('#enter_user').click(function () {
//   var nick = $('#username').val();
//   var pass = $('#pass').val();
//
//   $.ajax({
//     url:'ajax/enter.php',
//     type:'POST',
//     cache:false,
//     data:{'username' : nick, 'pass': pass },
//     dataType: 'html',
//     success: function(data){
//     if(data == 'готово'){
//       $('#enter_user').text('Всё готово');
//       $('#errorBlock2').hide();
//         document.location.reload(true);
//       }
//     else {
//         $('#errorBlock2').show();
//         $('#errorBlock2').text(data);
//       }
//     }
//   });
// }); -->
 <!-- </script> -->

</body>
</html>
