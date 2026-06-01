<?php

	namespace app\controllers;
	use app\models\mainModel;

	class userController extends mainModel{

		/*----------  Controlador registrar usuario  ----------*/
		public function registrarUsuarioControlador(){

			# Sanitizando datos
			$nombre=$this->limpiarCadena($_POST['usuario_nombre']);
			$apellido=$this->limpiarCadena($_POST['usuario_apellido']);

			$usuario=$this->limpiarCadena($_POST['usuario_usuario']);
			$email=$this->limpiarCadena($_POST['usuario_email']);
			$clave1=$this->limpiarCadena($_POST['usuario_clave_1']);
			$clave2=$this->limpiarCadena($_POST['usuario_clave_2']);
			
			# Validación campos obligatorios #
			if($nombre=="" || $apellido=="" || $usuario=="" || $clave1=="" || $clave2==""){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No has llenado todos los campos que son obligatorios",
					"icono"=>"error"
				];
				return json_encode($alerta);
				exit();
			}

			# Validación de tipos de datos y largo de los mismos  para: #
			//Nombre
			if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$nombre)){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El NOMBRE no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
				exit();
			}

			//Apellido
			if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$apellido)){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El APELLIDO no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
				exit();
			}

			// Usuario
			if($this->verificarDatos("[a-zA-Z0-9]{4,20}",$usuario)){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El USUARIO no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
				exit();
			}

			// Passwords y repetición
			if($this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}",$clave1) || $this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}",$clave2)){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"Las CLAVES no coinciden con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
				exit();
			}

			//Validación del email 
			if($email!=""){
				//Verficamos que sea un email válido
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
					$check_email=$this->ejecutarConsulta("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");

					// Verificamos si el email ya existe
					if($check_email->rowCount()>0){
						$alerta=[
							"tipo"=>"simple",
							"titulo"=>"Ocurrió un error inesperado",
							"texto"=>"El EMAIL que acaba de ingresar ya se encuentra registrado en el sistema, por favor verifique e intente nuevamente",
							"icono"=>"error"
						];
						return json_encode($alerta);
						exit();
					}
				}else{
					//si el campo email está vacío
					$alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error inesperado",
						"texto"=>"Ha ingresado un correo electrónico no valido",
						"icono"=>"error"
					];
					return json_encode($alerta);
					exit();
				}
			}

			// Validación de coincidencia de passwords
			if($clave1!=$clave2){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"Las contraseñas que acaba de ingresar no coinciden, por favor verifique e intente nuevamente",
					"icono"=>"error"
				];
				return json_encode($alerta);
				exit();
			}else{
				$clave=password_hash($clave1,PASSWORD_BCRYPT,["cost"=>10]);
      }

			// Validación de usuario único
			$check_usuario = $this->ejecutarConsulta("SELECT usuario_usuario FROM usuario WHERE usuario_usuario='$usuario'");
			if($check_usuario->rowCount()>0){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El USUARIO ingresado ya se encuentra registrado, por favor elija otro",
					"icono"=>"error"
				];
				return json_encode($alerta);
				exit();
			}

			// Directorio de imagenes 
			$img_dir="../../public/img/fotos/";

			// Validación de foto recibida
			if($_FILES['usuario_foto']['name']!="" && $_FILES['usuario_foto']['size']>0){

				// Creando directorio 
				if(!file_exists($img_dir)){ // Si el directorio no existe, lo creamos
					if(!mkdir($img_dir,0777)){ // Si no se puede crear el directorio, notificamos
						$alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error inesperado",
						"texto"=>"Error al crear el directorio",
						"icono"=>"error"
					];
					return json_encode($alerta);
						exit();
					} 
				}

				//Validación formato de imagenes
				if(mime_content_type($_FILES['usuario_foto']['tmp_name'])!="image/jpeg" && mime_content_type($_FILES['usuario_foto']['tmp_name'])!="image/png"){
					$alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error inesperado",
						"texto"=>"La imagen que ha seleccionado es de un formato no permitido",
						"icono"=>"error"
					];
					return json_encode($alerta);
					exit();
				}

				//Validación tamaño de imagen
				if(($_FILES['usuario_foto']['size']/1024)>5120){
					$alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error inesperado",
						"texto"=>"La imagen que ha seleccionado supera el peso permitido",
						"icono"=>"error"
					];
					return json_encode($alerta);
					exit();
				}

				// Funcionalidad para generar nombre de archivo a guardar
				$foto=str_ireplace(" ","_",$nombre); // Reemplaza espacios por guiones bajos
				$foto=$foto."_".rand(0,100); // Agrega numero aleatorio

				// Funcionalidad para obtener extensión de archivo a guardar
				switch(mime_content_type($_FILES['usuario_foto']['tmp_name'])){
						case 'image/jpeg':
								$foto=$foto.".jpg";
						break;
						case 'image/png':
								$foto=$foto.".png";
						break;
				}

				chmod($img_dir,0777); // Damos permisos de escritura al directorio

				// Funcionalidad para mover archivo a directorio
				if(!move_uploaded_file($_FILES['usuario_foto']['tmp_name'],$img_dir.$foto)){
					$alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error inesperado",
						"texto"=>"No podemos subir la imagen al sistema en este momento",
						"icono"=>"error"
					];
					return json_encode($alerta);
					exit();
				}

			}else{
				$foto="";
			}

			//Array de arrays asociativos de datos a guardar en la base de datos
			$usuario_datos_reg=[
				[
					"campo_nombre"=>"usuario_nombre",
					"campo_marcador"=>":Nombre",
					"campo_valor"=>$nombre
				],
				[
					"campo_nombre"=>"usuario_apellido",
					"campo_marcador"=>":Apellido",
					"campo_valor"=>$apellido
				],
				[
					"campo_nombre"=>"usuario_usuario",
					"campo_marcador"=>":Usuario",
					"campo_valor"=>$usuario
				],
				[
					"campo_nombre"=>"usuario_email",
					"campo_marcador"=>":Email",
					"campo_valor"=>$email
				],
				[
					"campo_nombre"=>"usuario_clave",
					"campo_marcador"=>":Clave",
					"campo_valor"=>$clave
				],
				[
					"campo_nombre"=>"usuario_foto",
					"campo_marcador"=>":Foto",
					"campo_valor"=>$foto
				],
				[
					"campo_nombre"=>"usuario_creado",
					"campo_marcador"=>":Creado",
					"campo_valor"=>date("Y-m-d H:i:s")
				],
				[
					"campo_nombre"=>"usuario_actualizado",
					"campo_marcador"=>":Actualizado",
					"campo_valor"=>date("Y-m-d H:i:s")
				]
			];

			// Funcionalidad para guardar datos en la base de datos
			$registrar_usuario=$this->guardarDatos("usuario",$usuario_datos_reg);

			// Validación de guardado de datos, y notificación de éxito o error
			if($registrar_usuario->rowCount()==1){
				$alerta=[
					"tipo"=>"limpiar",
					"titulo"=>"Usuario registrado",
					"texto"=>"El usuario ".$nombre." ".$apellido." se registro con exito",
					"icono"=>"success"
				];
			}else{	
				if(is_file($img_dir.$foto)){ // si falla el guardado de los datos en la DB, se elimina la foto
						chmod($img_dir.$foto,0777);
						unlink($img_dir.$foto);
				}
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No se pudo registrar el usuario, por favor intente nuevamente",
					"icono"=>"error"
				];
			}
			return json_encode($alerta);
		}

		/*----------  Controlador listar usuario  ----------*/
		public function listarUsuarioControlador($pagina,$registros,$url,$busqueda){
			/* Sanitizamos los datos recibidos */
			$pagina=$this->limpiarCadena($pagina);

			$registros=$this->limpiarCadena($registros);

			$url=$this->limpiarCadena($url);
			$url=APP_URL.$url."/";

			$busqueda=$this->limpiarCadena($busqueda);

			/* inicializamos la tabla */
			$tabla="";

			/* Verificamos los datos de la pagina y si no es valido, lo seteamos a 1 */
			$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;

			/* Si la pagina es mayor a 1, calculamos el registro inicila del paginado, sino el inicio es 0 */
			$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;

			if(isset($busqueda) && $busqueda != ""){
				/* Si hay busqueda, se realiza la consulta para mostrar los registros filtrados y paginados, y el total de los mismos */

				$consulta_datos="SELECT * FROM usuario WHERE ((usuario_id != '".$_SESSION['id']."' AND usuario_id != '1') AND (usuario_nombre LIKE '%$busqueda%' OR usuario_apellido LIKE '%$busqueda%' OR usuario_email LIKE '%$busqueda%' OR usuario_usuario LIKE '%$busqueda%')) ORDER BY usuario_nombre ASC LIMIT $inicio,$registros";

				$consulta_total="SELECT COUNT(usuario_id) FROM usuario WHERE ((usuario_id != '".$_SESSION['id']."' AND usuario_id != '1') AND (usuario_nombre LIKE '%$busqueda%' OR usuario_apellido LIKE '%$busqueda%' OR usuario_email LIKE '%$busqueda%' OR usuario_usuario LIKE '%$busqueda%'))";


			}else{
				/* Si no hay busqueda, se realiza la consulta para mostrar todos los registros paginados y el total de los mismos */
				$consulta_datos="SELECT * FROM usuario WHERE usuario_id != '".$_SESSION['id']."' AND usuario_id != '1' ORDER BY usuario_nombre ASC LIMIT $inicio,$registros";
				$consulta_total="SELECT COUNT(usuario_id) FROM usuario WHERE usuario_id != '".$_SESSION['id']."' AND usuario_id != '1'";
			}

			/* Ejecutamos la consulta para mostrar los registros */
			$datos = $this->ejecutarConsulta($consulta_datos);
			$datos = $datos->fetchAll();

			 /* Ejecutamos la consulta para mostrar el total de registros */
			$total = $this->ejecutarConsulta($consulta_total);
			$total = (int) $total->fetchColumn();

			 /* Calculamos el total de paginas */
			$numeroPaginas =ceil($total/$registros);
			$pag_final=0;

			/* Concatenamos el encabezado de la tabla */
			$tabla.='
						<div class="table-container">
							<table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
								<thead>
									<tr>
										<th class="has-text-centered">#</th>
										<th class="has-text-centered">Nombre</th>
										<th class="has-text-centered">Usuario</th>
										<th class="has-text-centered">Email</th>
										<th class="has-text-centered">Creado</th>
										<th class="has-text-centered">Actualizado</th>
										<th class="has-text-centered" colspan="3">Opciones</th>
									</tr>
								</thead>
								<tbody>
			';

			/* Si hay registros y la pagina es menor o igual a la cantidad de paginas... */
			if($total>=1 && $pagina<=$numeroPaginas){

				/* inicializamos el contador y el inicio de pagina */
				$contador=$inicio+1;
				$pag_inicio=$inicio+1;

				/* Recorremos los registros y generamos las filas de la tabla */
				foreach($datos as $rows){
					$tabla.='
						<tr class="has-text-centered" >
							<td>'.$contador.'</td>
							<td>'.$rows['usuario_nombre'].' '.$rows['usuario_apellido'].'</td>
							<td>'.$rows['usuario_usuario'].'</td>
							<td>'.$rows['usuario_email'].'</td>
							<td>'.date("d-m-Y  h:i:s A",strtotime($rows['usuario_creado'])).'</td>
							<td>'.date("d-m-Y  h:i:s A",strtotime($rows['usuario_actualizado'])).'</td>
							<td>
									<a href="'.APP_URL.'userPhoto/'.$rows['usuario_id'].'/" class="button is-info is-rounded is-small">Foto</a>
							</td>
							<td>
									<a href="'.APP_URL.'userUpdate/'.$rows['usuario_id'].'/" class="button is-success is-rounded is-small">Actualizar</a>
							</td>
							<td>
								<form class="FormularioAjax" action="'.APP_URL.'app/ajax/usuarioAjax.php" method="POST" autocomplete="off" >
									<input type="hidden" name="modulo_usuario" value="eliminar">
									<input type="hidden" name="usuario_id" value="'.$rows['usuario_id'].'">
									<button type="submit" class="button is-danger is-rounded is-small">Eliminar</button>
								</form>
							</td>
						</tr>
					';
					$contador++;
				}

				/* Calculamos la pagina final */
				$pag_final=$contador-1;
			} else {
				/* Si hay registros pero la pagina no existe, mostramos un mensaje de alerta */
				if($total>=1){
					$tabla.='
						<tr class="has-text-centered" >
							<td colspan="7">
								<a href="'.$url.'1/" class="button is-link is-rounded is-small mt-4 mb-4">
									Haga clic acá para recargar el listado
								</a>
							</td>
						</tr>
					';
				} else {
					/* Si no hay registros, mostramos un mensaje de alerta */
					$tabla.='
						<tr class="has-text-centered" >
							<td colspan="7">
								No hay registros en el sistema
							</td>
						</tr>
					';
				}
			}

			/* Concatenamos el cierre de la tabla */
			$tabla.='
								</tbody>
							</table>
						</div>
			';

			/* Paginador */
			if($total>0 && $pagina<=$numeroPaginas){
				$tabla.='<p class="has-text-right">
										Mostrando usuarios 
										<strong>'.$pag_inicio.'</strong> 
										al 
										<strong>'.$pag_final.'</strong> 
										de un 
										<strong>total de '.$total.'</strong>
									</p>
				';

				$tabla.=$this->paginadorTablas($pagina,$numeroPaginas,$url,7);
			}

			return $tabla;
		}

		/*----------  Controlador eliminar usuario  ----------*/
		public function eliminarUsuarioControlador(){
			/* Sanitizamos los datos recibidos */
			$id=$this->limpiarCadena($_POST['usuario_id']);

			/* Verificamos que el usuario no sea el administrador */
			if($id==1){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No podemos eliminar el usuario principal del sistema",
					"icono"=>"error"
				];
				return json_encode($alerta);
			}
			
			/* Verificamos que el usuario exista */
			$datos=$this->ejecutarConsulta("SELECT * FROM usuario WHERE usuario_id='$id'");

			if($datos->rowCount()<=0){
			/* Si no existe, notificamos al usuario */
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos encontrado el usuario en el sistema",
					"icono"=>"error"
				];
				return json_encode($alerta);
			}else{
				/* Si existe lo procesamos */
				$datos=$datos->fetch();
			}

			/* Eliminamos el usuario */
			$eliminarUsuario=$this->eliminarRegistro("usuario","usuario_id",$id);

			if($eliminarUsuario->rowCount()==1){

				if(is_file("../views/fotos/".$datos['usuario_foto'])){
					chmod("../views/fotos/".$datos['usuario_foto'],0777);
					unlink("../views/fotos/".$datos['usuario_foto']);
				}

				$alerta=[
					"tipo"=>"recargar",
					"titulo"=>"Usuario eliminado",
					"texto"=>"El usuario ".$datos['usuario_nombre']." ".$datos['usuario_apellido']." ha sido eliminado del sistema correctamente",
					"icono"=>"success"
				];

			}else{

				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos podido eliminar el usuario ".$datos['usuario_nombre']." ".$datos['usuario_apellido']." del sistema, por favor intente nuevamente",
					"icono"=>"error"
				];

			}

			/* Devolvemos el resultado */
			return json_encode($alerta);
		}

		/*----------  Controlador actualizar usuario  ----------*/
		public function actualizarUsuarioControlador(){

			# Sanitizamos los datos recibidos
			$id=$this->limpiarCadena($_POST['usuario_id']);

			# Alamacenamos la consulta
			$datos=$this->ejecutarConsulta("SELECT * FROM usuario WHERE usuario_id='$id'");

			# Verificamos que el usuario exista
			if($datos->rowCount()<=0){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos encontrado el usuario en el sistema",
					"icono"=>"error"
				];
				return json_encode($alerta);
				exit();
			}else{
				$datos=$datos->fetch();
			}

			# Almacenamos las credenciales de quien esta actualizando el usuario
			$admin_usuario=$this->limpiarCadena($_POST['administrador_usuario']);
			$admin_clave=$this->limpiarCadena($_POST['administrador_clave']);

			# Verificamos las credenciales
			if($admin_usuario=="" || $admin_clave==""){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No ha llenado todos los campos que son obligatorios, que corresponden a su USUARIO y CLAVE",
					"icono"=>"error"
				];
				return json_encode($alerta);
				exit();
			}

		# Validamos los datos de admin_usuario
		if($this->verificarDatos("[a-zA-Z0-9]{4,20}",$admin_usuario)){
			$alerta=[
				"tipo"=>"simple",
				"titulo"=>"Ocurrió un error inesperado",
				"texto"=>"Su USUARIO no coincide con el formato solicitado",
				"icono"=>"error"
			];
			return json_encode($alerta);
			exit();
		}

		# Validamos los datos de admin_clave
		if($this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}",$admin_clave)){
			$alerta=[
				"tipo"=>"simple",
				"titulo"=>"Ocurrió un error inesperado",
				"texto"=>"Su CLAVE no coincide con el formato solicitado",
				"icono"=>"error"
			];
			return json_encode($alerta);
			exit();
		}


		}
	}

?>