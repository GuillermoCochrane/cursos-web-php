<div class="container is-fluid mb-6">
	<?php $id=$insLogin->limpiarCadena($url[1]);?>
  <?php if($id==$_SESSION['id']){ ?>
    <h1 class="title">Mi cuenta</h1>
    <h2 class="subtitle">Actualizar cuenta</h2>
  <?php }else{ ?>
    <h1 class="title">Usuarios</h1>
    <h2 class="subtitle">Actualizar usuario</h2>
  <?php } ?>
</div>
<div class="container pb-6 pt-6">
	<?php
		include "./app/views/inc/btn_back.php";

    // Seleccionar datos del usuario
		$datos=$insLogin->seleccionarDatos("Unico","usuario","usuario_id",$id);
  ?>
  <?php if($datos->rowCount()==1) { $datos=$datos->fetch(); ?>

  <?php } else { ?>

  <?php } ?>
</div>