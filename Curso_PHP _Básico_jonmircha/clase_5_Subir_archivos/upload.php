<?php
  $datos_archivo = $_FILES['archivo'];
  foreach ($datos_archivo as $clave => $valor) {
    echo "Propiedad: $clave, => Valor: $valor, <br>";
  }

  $archivo = $datos_archivo['tmp_name'];
  $nombre_archivo = $datos_archivo['name'];
  $destino = "uploaded/$nombre_archivo";
  move_uploaded_file($archivo, $destino);
  echo "<br> Archivo $nombre_archivo subido correctamente al servidor!!!";
?>