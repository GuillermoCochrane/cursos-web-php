<?php
  session_start();
  // Si no está autentificado, lo mandamos a salir.php para limpiar todo
  if (!isset($_SESSION["autentificado"]) || !$_SESSION["autentificado"]) {
      header("Location: salir.php");
      exit();
  }
?>