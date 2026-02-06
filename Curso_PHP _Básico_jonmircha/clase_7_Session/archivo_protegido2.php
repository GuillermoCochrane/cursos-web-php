<?php
  include("./session.php");
  include("./templates/header.php");
?>
    <h1>Bienvenido, <?php echo $_SESSION["usuario"]; ?>!</h1>
    <p>Estás en otra página segura con sesiones en PHP.</p>
    <a href="archivo_protegido.php" role="button">Ir a página 1</a><br><br>
    <a href="salir.php" class="secondary outline" role="button">Salir</a>

<?php include("./templates/footer.php"); ?>