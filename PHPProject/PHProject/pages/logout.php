<?php
session_start();
session_unset();  
session_destroy();  


header("Location: /PHProject/pages/index.php"); 
exit();
?>
