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
    <br>
    <h2 style="text-align: center;">Formulario con GET</h2>
  </hgroup>
  <form 
    action="validaciones.php" 
    method="get" 
    style="width: 300px; margin:auto" 
    enctype="application/x-www-form-urlencoded"
    id="get_form"
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
    <?php
      # error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); // desactiva todos los mensajes de error
      if (isset($_GET['error']) && $_GET['error'] == 'true') {
        echo "<span style='color: red;'>Error: Credenciales inválidas</span>";
      }
    ?>
  </form>

  <br>

  <hgroup>
    <h2 style="text-align: center;">Formulario con POST</h2>
  </hgroup>

  <form 
    action="validaciones.php" 
    method="post" 
    style="width: 300px; margin:auto" 
    enctype="application/x-www-form-urlencoded"
    id="post_form"
  >
    <label for="nombre_post">Nombre:</label>
    <input type="text" id="nombre_post" name="nombre" placeholder="Ingrese su nombre">
    <label for="password_post">Contraseña:</label>
    <input type="password" id="password_post" name="password" placeholder="Ingrese su contraseña">
    <label>Sexo:</label>
    <input type="radio" name="sexo" id="sexo_masculino_post" value="masculino">
    <label for="sexo_masculino_post">Masculino</label>
    <input type="radio" name="sexo" id="sexo_femenino_post" value="femenino">
    <label for="sexo_femenino_post">Femenino</label>
    <input type="hidden" name="hidden-post" value="post" id="hidden.post">
    <br><br>
    <input type="button" value="Enviar por POST" name="enviar" id="enviar-post">
    <?php
      if (isset($_GET['error_post']) && $_GET['error_post'] == 'true') {
        echo "<span style='color: red;'>Error: Credenciales inválidas</span>";
      }
    ?>
  </form>
  <br>

</body>
<script>
  window.addEventListener("load", function() {
    const $ = function(selector) {
      return document.querySelector(selector);
    };

    const $enviarGet = $('#enviar-get');
    const $enviarPost = $('#enviar-post');

    function validarGet() {
      let verificar = true;
      const $get_form = $('#get_form');
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
      } else if (!$sexo_masculino.checked && !$sexo_femenino.checked) { //verificamos si el campo sexo esta vacio
        alert('El campo sexo es obligatorio');
        $sexo_masculino.focus();
        verificar = false;
      }

      if (verificar) {
        $get_form.submit();
      }
    }

    function validarPost() {
      let verificar_post = true;
      const $post_form = $('#post_form');
      const $nombre = $('#nombre_post');
      const $password = $('#password_post');
      const $sexo_masculino = $('#sexo_masculino_post');
      const $sexo_femenino = $('#sexo_femenino_post');
      const $hidden = $('#hidden.post');

      if (!$nombre.value) { //verificamos si el campo nombre esta vacio
        alert('El campo nombre es obligatorio');
        $nombre.focus();
        verificar_post = false;
      } else if (!$password.value) { //verificamos si el campo password esta vacio  
        alert('El campo password es obligatorio');
        $password.focus();
        verificar_post = false;
      } else if (!$sexo_masculino.checked && !$sexo_femenino.checked) { //verificamos si el campo sexo esta vacio
        alert('El campo sexo es obligatorio');
        $sexo_masculino.focus();
        verificar_post = false;
      } 

      if (verificar_post) {
        $post_form.submit();
      }
    }

    // Event listener
    $enviarGet.onclick = validarGet;
    $enviarPost.onclick = validarPost;

  })
</script>
</html>