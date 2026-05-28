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

    <h2 class="title has-text-centered"><?php echo $datos['usuario_nombre']." ".$datos['usuario_apellido']; ?></h2>

    <p class="has-text-centered pb-6"><?php echo "<strong>Usuario creado:</strong> ".date("d-m-Y  h:i:s A",strtotime($datos['usuario_creado']))." &nbsp; <strong>Usuario actualizado:</strong> ".date("d-m-Y  h:i:s A",strtotime($datos['usuario_actualizado'])); ?></p>

  <?php } else { include "./app/views/inc/error_alert.php";} ?> 
</div>