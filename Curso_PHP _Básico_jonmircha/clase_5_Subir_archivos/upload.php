<?php
  $datos_archivo = $_FILES['archivo'];
  foreach ($datos_archivo as $clave => $valor) {
    echo "Propiedad: $clave, => Valor: $valor, <br>";
  }
?>