<?php
@session_start();

session_destroy();

header("location: /akademik/login.php");
?>
