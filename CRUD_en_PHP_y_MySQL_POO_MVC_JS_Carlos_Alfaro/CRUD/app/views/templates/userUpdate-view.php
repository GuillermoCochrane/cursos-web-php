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