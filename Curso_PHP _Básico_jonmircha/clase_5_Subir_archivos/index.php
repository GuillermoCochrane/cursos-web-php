<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Subir archivos</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css" />
</head>
<body>
  <hgroup>
    <h1 style="text-align: center;">Subir archivos</h1>
  </hgroup>
  <form 
    action="upload.php" 
    method="post" 
    style="width: 300px; margin:auto" 
    enctype="multipart/form-data"
  >
    <label for="archivo">Archivo a subir:</label>
    <input type="file" id="archivo" name="archivo" placeholder="Ingrese su archivo">
    <input type="submit" value="Enviar" name="enviar">
    <?php
      # error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); // desactiva todos los mensajes de error
      if (isset($_GET['error']) && $_GET['error'] == 'true') {
        echo "<span style='color: red;'>Error: Credenciales inválidas</span>";
      }
    ?>
  </form>

</body>
</html>