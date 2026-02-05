<?php
  // procesa formularios con GET
  $nombre = "guille";
  $password = "123456";

  if (isset($_GET['hidden-get'])) {
    $nombre_get = $_GET['nombre'];
    $password_get = $_GET['password'];
    if ($nombre_get == $nombre && $password_get == $password) {
      echo "Formulario procesado por GET <br>";
      echo "Hola $nombre_get <br>";
      echo "Su contraseña es $password_get <br>";
      echo "y el sexo es " . $_GET['sexo'];
    } else {
      header("Location: index.php?error=true");
    }
  }
?>