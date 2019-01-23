<?php

session_start();
$token = md5(session_id());
$login = $_SESSION['usu'];
$filtro = filter_input_array(INPUT_GET, FILTER_DEFAULT);
if(isset($filtro['token']) && $filtro['token'] === $token) {
   session_unset();
   session_destroy();
   setcookie(session_name(),'',0,'/');
   echo "<script>alert('Você Saiu!');</script>";
   echo '<script>window.location.href="../index.php?usu='.$login.'"</script>';
} else {
   echo '<a href="logout.php?token='.$token.'">Confirmar logout</a>';
}

