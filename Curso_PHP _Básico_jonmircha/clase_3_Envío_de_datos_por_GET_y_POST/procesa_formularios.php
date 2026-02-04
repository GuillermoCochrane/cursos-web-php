<?php
  // procesa formularios con GET
  if (isset($_GET['enviar'])) {
    $nombre = $_GET['nombre'];
    $apellido = $_GET['apellido'];
    $password = $_GET['password'];

    echo "Formualrio procesado por GET <br>";
    echo "Hola $nombre $apellido <br>";
    echo "Su contraseña es $password <br>";
  };