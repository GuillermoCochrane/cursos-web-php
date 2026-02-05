<?php
  $datos_archivo = $_FILES['archivo'];
  foreach ($datos_archivo as $clave => $valor) {
    echo "Propiedad: $clave, => Valor: $valor, <br>";
  }

  $archivo = $datos_archivo['tmp_name'];
  $nombre_archivo = $datos_archivo['name'];
  $tipo_archivo = $datos_archivo['type'];
  $destino = "uploaded/$nombre_archivo";

  if ($tipo_archivo == "text/plain") {
    move_uploaded_file($archivo, $destino);
    echo "<br> Archivo $nombre_archivo subido correctamente al servidor!!!";
  } else {
    echo "Solo se permiten archivos de texto plano <br>";
    echo "<a href='index.php'>Volver</a>";
  }
?>