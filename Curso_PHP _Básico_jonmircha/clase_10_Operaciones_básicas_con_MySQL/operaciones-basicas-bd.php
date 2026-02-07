<?php
  /* 1. Conectarse al servidor [00:07:37] */
  $conexion = mysql_connect("localhost", "root", "") or die("No se pudo conectar");

  /* 2. Seleccionar la BD [00:12:45] */
  mysql_select_db("mis_contactos") or die("No se pudo seleccionar la BD");
  echo "<h1>Operaciones sobre la BD mis_contactos</h1>";

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
/* A. Inserción (INSERT) */
  $consulta = "INSERT INTO contactos (email, nombre, sexo, nacimiento, telefono, pais, imagen) 
             VALUES ('jon@email.com', 'Jonathan', 'M', '1984-05-23', '52555555', 'México', 'foto.png')";
  $ejecutar_consulta = mysql_query($consulta, $conexion);
  echo "Datos insertados <br />";
//B. Eliminación (DELETE) [59:10]

$consulta = "DELETE FROM contactos WHERE email = 'jon@email.com'";
$ejecutar_consulta = mysql_query($consulta, $conexion);
echo "Datos eliminados <br />";

//C. Modificación (UPDATE) [01:08:06]
$consulta = "UPDATE contactos SET email = 'cursos@email.com', nombre = 'Bextlan' 
             WHERE email = 'jon@email.com'";
$ejecutar_consulta = mysql_query($consulta, $conexion);
echo "Datos modificados <br />";

//D. Consulta con Filtros (SELECT + WHERE) [01:15:28]
$consulta = "SELECT * FROM contactos WHERE nombre = 'Bextlan'";
$ejecutar_consulta = mysql_query($consulta, $conexion);

echo "<h3>Listado de Contactos:</h3>";
while($registro = mysql_fetch_array($ejecutar_consulta)) {
    // Imprime el ID y el Nombre de la tabla contactos
    echo $registro["id_contacto"] . " - " . $registro["nombre"] . "<br />";
}
mysql_close($conexion);
?>