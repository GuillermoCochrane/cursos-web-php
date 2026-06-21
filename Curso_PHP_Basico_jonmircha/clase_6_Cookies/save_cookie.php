<?php
  # procesa la variable recibida por GET y crea la cookie.
  // setCookie(nombre, valor, tiempo, ruta);
  // El tiempo 86400 segundos = 24 horas
  $cookie_name = "selected_language";
  $cookie_value = $_GET["language"];
  echo "Cookie $cookie_name creado con valor $cookie_value";
  $cookie_expires = time() + 86400;
  setcookie($cookie_name, $cookie_value, $cookie_expires, "/");
  header("Location: use_cookie.php");
?>