<?php
  # Archivo para "eliminar" la cookie dándole un tiempo negativo
  $cookie = "selected_language";
  $cookie_time = time() - 86400;
  setcookie($cookie, "", $cookie_time, "/");
?>
<a href="index.php">Regresar</a>