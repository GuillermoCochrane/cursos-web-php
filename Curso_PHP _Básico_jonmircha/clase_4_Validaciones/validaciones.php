<?php
  // procesa formularios con GET
  $nombre = "guille";
  $password = "123456";

  if (isset($_GET['hidden-get'])) {
    $nombre_get = $_GET['nombre'];
    $password_get = $_GET['password'];
    if ($nombre_get == $nombre && $password_get == $password) {
      echo "Formulario procesado por GET <br>";
      echo "Hola!! $nombre_get <br>";
      echo "Su contraseña es $password_get <br>";
      echo "y el sexo es " . $_GET['sexo'];
    } else {
      header("Location: index.php?error=true");
    }
  }

  if (isset($_POST['hidden-post'])) {
    $nombre_post = $_POST['nombre'];
    $password_post = $_POST['password'];
    if ($nombre_post == $nombre && $password_post == $password) {
      echo "Formulario procesado por POST <br>";
      echo "Hola!! $nombre_post <br>";
      echo "Su contraseña es $password_post <br>";
      echo "y el sexo es " . $_POST['sexo'];
    } else {
      header("Location: index.php?error_post=true");
    }
  }
?>