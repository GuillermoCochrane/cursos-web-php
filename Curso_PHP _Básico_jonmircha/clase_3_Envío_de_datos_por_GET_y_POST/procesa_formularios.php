<?php
  // procesa formularios con GET
  if (isset($_GET['enviar'])) {
    $nombre = $_GET['nombre'];
    $apellido = $_GET['apellido'];
    $password = $_GET['password'];

    echo "Formualrio procesado por GET <br>";
    echo "Hola $nombre $apellido <br>";
    echo "Su contraseña es $password <br>";
  } elseif (isset($_POST['enviar'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $password = $_POST['password'];

    echo "Formualrio procesado por POST <br>";
    echo "Hola $nombre $apellido <br>";
    echo "Su contraseña es $password <br>";
  } else {
    echo "Formulario sin datos <br>";
  };