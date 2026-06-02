<div class="container is-fluid mb-6">
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
		include "./app/views/inc/btn_back.php";
		$datos=$insLogin->seleccionarDatos("Unico","usuario","usuario_id",$id);
  ?>
