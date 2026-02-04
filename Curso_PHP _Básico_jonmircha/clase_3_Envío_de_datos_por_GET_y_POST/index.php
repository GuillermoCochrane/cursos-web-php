<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formularios con GET y POST</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css" />
</head>
<body>
  <hgroup>
    <h1 style="text-align: center;">Formularios con GET y POST</h1>
    <h2 style="text-align: center;">Formulario con GET</h2>
  </hgroup>
  <form 
    action="procesa_formularios.php" 
    method="get" 
    style="width: 300px; margin:auto" 
    enctype="application/x-www-form-urlencoded" 
  >
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre">
    <br><br>
    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="apellido" placeholder="Ingrese su apellido">
    <br><br>
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" placeholder="Ingrese su contraseña">
    <br><br>
    <input type="submit" value="Enviar">
    <br>
  </form>

  <br>

  <hgroup>
    <h2 style="text-align: center;">Formulario con POST</h2>
  </hgroup>
  <form 
    action="procesa_formularios.php" 
    method="post" 
    style="width: 300px; margin:auto" 
  >
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre">
    <br><br>
    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="apellido" placeholder="Ingrese su apellido">
    <br><br>
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" placeholder="Ingrese su contraseña">
    <br><br>
    <input type="submit" value="Enviar">
    <br>
  </form>
</body>
</html>