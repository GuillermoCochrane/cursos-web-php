<?php
  include("./templates/header.php");
?>
  <hgroup>
    <h1 style="text-align: center;">Sessions en PHP</h1>
    <h2 style="text-align: center;">Formulario de login</h2>
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
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" placeholder="Ingrese su contraseña">
    <br><br>
    <input type="submit" value="Enviar" name="enviar">
    <br>
    <?php
      # error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); // desactiva todos los mensajes de error
      if (isset($_GET['error']) && $_GET['error'] == 'true') {
        echo "<span style='color: red;'>Error: Credenciales inválidas</span>";
      }
    ?>
  </form>
<?php
  include("./templates/footer.php");
?>