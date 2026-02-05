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
    <input type="hidden" name="hidden-get" value="get" id="hidden.get">
    <br><br>
    <input type="button" value="Enviar por GET" name="enviar" id="enviar-get">
  </form>

  <br>

</body>
<script>
  windows.addEventlistener("load", function() {
    const $ = function(selector) {
      return document.querySelector(selector);
    };

    const $enviarGet = $('#enviar-get');

    function validarGet() {
      let verificar = true;
      const $nombre = $('#nombre');
      const $password = $('#password');
      const $sexo_masculino = $('#sexo_masculino');
      const $sexo_femenino = $('#sexo_femenino');
      const $hidden = $('#hidden.get');

      if (!$nombre.value) { //verificamos si el campo nombre esta vacio
        alert('El campo nombre es obligatorio');
        $nombre.focus();
        verificar = false;
      } else if (!$password.value) { //verificamos si el campo password esta vacio
        alert('El campo password es obligatorio');
        $password.focus();
        verificar = false;
      }
    }

    // Event listener
    $enviarGet.onclick = validarGet;

  })
</script>
</html>