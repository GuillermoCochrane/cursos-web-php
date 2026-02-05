<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Validaciones</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css" />
</head>
<body>
  <hgroup>
    <h1 style="text-align: center;">Validaciones de datos</h1>
  </hgroup>
  <form 
    action="validaciones.php" 
    method="get" 
    style="width: 300px; margin:auto" 
    enctype="application/x-www-form-urlencoded" 
  >
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre">
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" placeholder="Ingrese su contraseña">
    <label>Sexo:</label>
    <input type="radio" name="sexo" id="sexo_masculino" value="masculino">
    <label for="sexo_masculino">Masculino</label>
    <input type="radio" name="sexo" id="sexo_femenino" value="femenino">
    <label for="sexo_femenino">Femenino</label>
    <br><br>
    <input type="button" value="Enviar por GET" name="enviar" id="enviar">
  </form>

  <br>

</body>
</html>