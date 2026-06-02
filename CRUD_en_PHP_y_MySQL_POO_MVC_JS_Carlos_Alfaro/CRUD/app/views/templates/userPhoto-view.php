<div class="container is-fluid mb-6">
  <!-- header dinamico -->
	<?php $id=$insLogin->limpiarCadena($url[1]); ?>
	<?php	if($id==$_SESSION['id']){ ?>
    <h1 class="title">Mi foto de perfil</h1>
    <h2 class="subtitle">Actualizar foto de perfil</h2>
	<?php }else{ ?>
    <h1 class="title">Usuarios</h1>
    <h2 class="subtitle">Actualizar foto de perfil</h2>
	<?php } ?>
</div>
<div class="container pb-6 pt-6">
	<?php	
    /* Boton de volver */
		include "./app/views/inc/btn_back.php";
		$datos=$insLogin->seleccionarDatos("Unico","usuario","usuario_id",$id);
  ?>
  <!-- Si el usuario existe -->
  <?php if($datos->rowCount()==1){ $datos=$datos->fetch(); ?>
  <!-- mostramos datos del usuario -->
  <h2 class="title has-text-centered">
    <?php echo $datos['usuario_nombre']." ".$datos['usuario_apellido']; ?>
  </h2>

	<p class="has-text-centered pb-6">
    <?php echo "<strong>Usuario creado:</strong> ".date("d-m-Y  h:i:s A",strtotime($datos['usuario_creado']))." &nbsp; <strong>Usuario actualizado:</strong> ".date("d-m-Y  h:i:s A",strtotime($datos['usuario_actualizado'])); ?>
  </p>

  <div class="columns">
		<div class="column is-two-fifths">
      <!-- Comprobamos si tiene imagen de perfil -->
      <?php if(is_file("./app/views/fotos/".$datos['usuario_foto'])){ ?>

      <?php } ?>
    </div>
  </div>

  <?php
    /* Si el usuario no existe, notificar error */
    }else {  
      include "./app/views/inc/error_alert.php";
    } 
  ?>
</div>