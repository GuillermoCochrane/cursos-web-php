<?php

	namespace app\controllers;
	use app\models\mainModel;

	class loginController extends mainModel{

		/*----------  Controlador iniciar sesion  ----------*/
		public function iniciarSesionControlador(){

			$usuario=$this->limpiarCadena($_POST['login_usuario']);
			$clave=$this->limpiarCadena($_POST['login_clave']);

			//Validación campos obligatorios
			if($usuario=="" || $clave==""){
					echo "<script>
									Swal.fire({
										icon: 'error',
										title: 'Ocurrió un error inesperado',
										text: 'No has llenado todos los campos que son obligatorios'
									});
								</script>";
			}else{
				// Validando integridad de los datos de usuario 
				if($this->verificarDatos("[a-zA-Z0-9]{4,20}",$usuario)){
					echo "<script>
									Swal.fire({
											icon: 'error',
											title: 'Ocurrió un error inesperado',
											text: 'El USUARIO no coincide con el formato solicitado'
										});
								</script>";
				}else{
					// Validando integridad de los datos de clave
					if($this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}",$clave)){
						echo "<script>
										Swal.fire({
											icon: 'error',
											title: 'Ocurrió un error inesperado',
											text: 'La CLAVE no coincide con el formato solicitado'
										});
									</script>";
					}else{
						// Consultamos por el usuario en la base de datos
						$check_usuario=$this->ejecutarConsulta("SELECT * FROM usuario WHERE usuario_usuario='$usuario'");
						if($check_usuario->rowCount()==1){

							$check_usuario=$check_usuario->fetch(); // Procesamos el resultado de la consulta

							if($check_usuario['usuario_usuario']==$usuario && password_verify($clave,$check_usuario['usuario_clave'])){
								// Si se valida el login con los datos del usuario, guardamos los datos en la sesión
								$_SESSION['id']=$check_usuario['usuario_id'];
								$_SESSION['nombre']=$check_usuario['usuario_nombre'];
								$_SESSION['apellido']=$check_usuario['usuario_apellido'];
								$_SESSION['usuario']=$check_usuario['usuario_usuario'];
								$_SESSION['foto']=$check_usuario['usuario_foto'];

								// redirijimos al usuario a la página de inicio de diferentes maneras, dependiendo de los headers
								if(headers_sent()){
									echo "<script> window.location.href='".APP_URL."dashboard/'; </script>";
								}else{
									header("Location: ".APP_URL."dashboard/");
								}

							}else{
								echo "<script>
												Swal.fire({
													icon: 'error',
													title: 'Ocurrió un error inesperado',
													text: 'Usuario o clave incorrectos'
												});
											</script>";
							}
						}else{
							echo "<script>
											Swal.fire({
												icon: 'error',
												title: 'Ocurrió un error inesperado',
												text: 'Usuario o clave incorrectos'
											});
										</script>";
						}
					}
				}
			}
		}

		
		/*----------  Controlador cerrar sesion  ----------*/
		public function cerrarSesionControlador(){
			session_destroy();
			
			if(headers_sent()){
				echo "<script> window.location.href='".APP_URL."login/'; </script>";
			}else{
				header("Location: ".APP_URL."login/");
			}
		}
	}
?>