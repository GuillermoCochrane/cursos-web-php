<?php
  /* 1. Conectarse al servidor [00:07:37] */
  $conexion = mysql_connect("localhost", "root", "") or die("No se pudo conectar");

  /* 2. Seleccionar la BD [00:12:45] */
  mysql_select_db("mis_contactos") or die("No se pudo seleccionar la BD");

  /* 3. Crear consulta SQL [00:16:22] */
  $consulta = "SELECT * FROM pais";

  /* 4. Ejecutar consulta [00:18:41] */
  $ejecutar_consulta = mysql_query($consulta, $conexion) or die("Error en la consulta");

  /* 5. Mostrar resultados (Ciclo While + Array Asociativo) [00:24:27] */
  while($registro = mysql_fetch_array($ejecutar_consulta)) {
      echo $registro["id_pais"] . " - " . $registro["pais"] . "<br />";
  }

  /* 6. Cerrar conexión [00:29:23] */
  mysql_close($conexion);
?>