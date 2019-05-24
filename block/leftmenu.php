<?php


if ($_COOKIE['position'] == 3) //значит игрок
{

require 'block/leftmenu_for_playing.php';

}
else if ($_COOKIE['position'] == 5) //значит мастер
{

require 'block/leftmenu_for_master.php';

}

else echo 'Ошибка при выводе меню!';

 ?>
