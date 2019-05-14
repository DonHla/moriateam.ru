<?php
 session_start();
$sessionValue = $_POST['master_count_div'];
// foreach ($sessionValue as $value) {
//   echo $value;
// }
 $_SESSION['masterInfName'] = $sessionValue[0];
echo $_SESSION['masterInfName'];
echo "replace";
?>
