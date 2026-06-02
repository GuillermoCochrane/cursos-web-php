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

        <!-- Si tiene imagen de perfil, la mostramos junto con un boton para eliminarla -->
        <figure class="image mb-6">
          <img class="is-rounded" src="<?php echo APP_URL; ?>app/views/fotos/<?php echo $datos['usuario_foto']; ?>">
        </figure>
        
        <form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/usuarioAjax.php" method="POST" autocomplete="off" >

          <input type="hidden" name="modulo_usuario" value="eliminarFoto">
          <input type="hidden" name="usuario_id" value="<?php echo $datos['usuario_id']; ?>">

          <p class="has-text-centered">
            <button type="submit" class="button is-danger is-rounded">Eliminar foto</button>
          </p>
        </form>

      <?php } else { ?>

      <!-- Si no tiene imagen de perfil, mostramos una imagen por defecto -->
        <figure class="image mb-6">
          <img class="is-rounded" src="<?php echo APP_URL; ?>app/views/fotos/default.png">
        </figure>
      <?php } ?>
    </div>
  </div>

  
		<div class="column">
			<form class="mb-6 has-text-centered FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/usuarioAjax.php" method="POST" enctype="multipart/form-data" autocomplete="off" >

				<input type="hidden" name="modulo_usuario" value="actualizarFoto">
				<input type="hidden" name="usuario_id" value="<?php echo $datos['usuario_id']; ?>">
				
				<label>Foto o imagen del usuario</label><br>

				<div class="file has-name is-boxed is-justify-content-center mb-6">
            <label class="file-label">
						<input class="file-input" type="file" name="usuario_foto" accept=".jpg, .png, .jpeg" >
						<span class="file-cta">
							<span class="file-label">
								Seleccione una foto
							</span>
						</span>
						<span class="file-name">JPG, JPEG, PNG. (MAX 5MB)</span>
					</label>
				</div>
				<p class="has-text-centered">
					<button type="submit" class="button is-success is-rounded">Actualizar foto</button>
				</p>
			</form>
		</div>

  <?php
    /* Si el usuario no existe, notificar error */
    }else {  
      include "./app/views/inc/error_alert.php";
    } 
  ?>
</div>