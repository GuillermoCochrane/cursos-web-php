<?php
  // imprimir informacion
  echo("Hola mundo <br>");

  //orea forma de imprimir
  echo "<h1>estoy aprendiendo php</h1> <br>";

  //Variables
  $nombre = "Guillermo";
  $Nombre = "Alejandro";
  echo "Hola $nombre  y $Nombre <br>";

  //concatanacion de strings y variables
  $nombre_unido = $nombre . " y " . $Nombre . "<br>";
  echo $nombre_unido;

  //valores numericos
  $numero = 10;
  $numero2 = 20;
  $suma = $numero + $numero2;
  echo "el valor de \$suma es " . $suma . "<br>"; // escapar con \ el caracter $
?>