<?php
	
	namespace app\models;
	use \PDO;

	if(file_exists(__DIR__."/../../config/server.php")){
		require_once __DIR__."/../../config/server.php";
	}

	class mainModel{

		private $server=DB_SERVER;
		private $db=DB_NAME;
		private $user=DB_USER;
		private $pass=DB_PASS;

		/*----------  Método para conectar a BD  ----------*/
		protected function conectar(){
			$conexion = new PDO("mysql:host=".$this->server.";dbname=".$this->db,$this->user,$this->pass);
			$conexion->exec("SET CHARACTER SET utf8");
			return $conexion;
		}

		/*----------  Método para ejecutar consultas  ----------*/
		protected function ejecutarConsulta($consulta){
			$sql=$this->conectar()->prepare($consulta);
			$sql->execute();
			return $sql;
		}

		/*----------  Método para sanitzador de cadenas para evitar SQL INJECTION  ----------*/
		public function limpiarCadena($cadena){

			$palabras=["<script>","</script>","<script src","<script type=","SELECT * FROM","SELECT "," SELECT ","DELETE FROM","INSERT INTO","DROP TABLE","DROP DATABASE","TRUNCATE TABLE","SHOW TABLES","SHOW DATABASES","<?php","?>","--","^","<",">","==","=",";","::"]; // reglas de sanitización

			$cadena=trim($cadena); //Elimina espacios en blanco del principio y fin del string
			$cadena=stripslashes($cadena); // Elimina barras invertidas del string (\)

			foreach($palabras as $palabra){
				$cadena=str_ireplace($palabra, "", $cadena); // Sanitizamos el string
			}

			//repetimos lo de arriba
			$cadena=trim($cadena);
			$cadena=stripslashes($cadena);

			return $cadena;
		}

		/*---------- Método para validar datos mediante expresiones regulares ----------*/
		protected function verificarDatos($filtro,$cadena){
			if(preg_match("/^".$filtro."$/", $cadena)){
				return false;
            }else{
                return true;
            }
		}

		/*----------  Método para ejecutar una consulta INSERT preparada  ----------*/
		protected function guardarDatos($tabla,$datos){
			#estructuro la query
			$query="INSERT INTO $tabla (";

			$C=0;
			foreach ($datos as $clave){
				if($C>=1){ $query.=","; }
				$query.=$clave["campo_nombre"];
				$C++;
			}
			
			$query.=") VALUES(";

			$C=0;
			foreach ($datos as $clave){
				if($C>=1){ $query.=","; }
				$query.=$clave["campo_marcador"];
				$C++;
			}

			$query.=")";

			#hago la consulta
			$sql=$this->conectar()->prepare($query);

			foreach ($datos as $clave){
				$sql->bindParam($clave["campo_marcador"],$clave["campo_valor"]);
			}

			$sql->execute();

			return $sql;
		}

		/*---------- Método seleccionar datos ----------*/
		public function seleccionarDatos($tipo,$tabla,$campo,$id){
			// Sanitizamos los datos
			$tipo=$this->limpiarCadena($tipo);
			$tabla=$this->limpiarCadena($tabla);
			$campo=$this->limpiarCadena($campo);
			$id=$this->limpiarCadena($id);

			// Ejecutamos la consulta
			if($tipo=="Unico"){ // consulta que devuelve un solo registro
					$sql=$this->conectar()->prepare("SELECT * FROM $tabla WHERE $campo=:ID");
					$sql->bindParam(":ID",$id);
			}elseif($tipo=="Normal"){ // consulta que devuelve todos los campos de una tabla
					$sql=$this->conectar()->prepare("SELECT $campo FROM $tabla");
			}
			$sql->execute();

			return $sql;
		}

		/*----------  Método para ejecutar una consulta UPDATE preparada  ----------*/
		protected function actualizarDatos($tabla,$datos,$condicion){
			
			$query="UPDATE $tabla SET ";

			$C=0;
			foreach ($datos as $clave){
				if($C>=1){ $query.=","; }
				$query.=$clave["campo_nombre"]."=".$clave["campo_marcador"];
				$C++;
			}

			$query.=" WHERE ".$condicion["condicion_campo"]."=".$condicion["condicion_marcador"];

			$sql=$this->conectar()->prepare($query);

			foreach ($datos as $clave){
				$sql->bindParam($clave["campo_marcador"],$clave["campo_valor"]);
			}

			$sql->bindParam($condicion["condicion_marcador"],$condicion["condicion_valor"]);

			$sql->execute();

			return $sql;
		}

		/*---------- Método eliminar registro ----------*/
		protected function eliminarRegistro($tabla,$campo,$id){
				$sql=$this->conectar()->prepare("DELETE FROM $tabla WHERE $campo=:id");
				$sql->bindParam(":id",$id);
				$sql->execute();
				
				return $sql;
		}

				/*---------- Método renderizador del sistema de paginado  ----------*/
		protected function paginadorTablas($pagina,$numeroPaginas,$url,$botones){
				$tabla='<nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">';

				# Botones estáticos iniciales

				if($pagina<=1){ // si es la primera página, deshabilita el botón "anterior"
						$tabla.='
						<a class="pagination-previous is-disabled" disabled >Anterior</a>
						<ul class="pagination-list">
						';
				}else{ 
						$tabla.='
						<a class="pagination-previous" href="'.$url.($pagina-1).'/">Anterior</a>
						<ul class="pagination-list">
								<li><a class="pagination-link" href="'.$url.'1/">1</a></li>
								<li><span class="pagination-ellipsis">&hellip;</span></li>
						';
				}


				# Botones dinámicos
				$ci=0;
				for($i=$pagina; $i<=$numeroPaginas; $i++){

						if($ci>=$botones){
								break;
						}

						if($pagina==$i){
								$tabla.='<li><a class="pagination-link is-current" href="'.$url.$i.'/">'.$i.'</a></li>';
						}else{
								$tabla.='<li><a class="pagination-link" href="'.$url.$i.'/">'.$i.'</a></li>';
						}

						$ci++;
				}

				# Botones estáticos finales

				if($pagina==$numeroPaginas){ //Si es la última pagina, deshabilita el botón "siguiente"
						$tabla.='
						</ul>
						<a class="pagination-next is-disabled" disabled >Siguiente</a>
						';
				}else{
						$tabla.='
								<li><span class="pagination-ellipsis">&hellip;</span></li>
								<li><a class="pagination-link" href="'.$url.$numeroPaginas.'/">'.$numeroPaginas.'</a></li>
						</ul>
						<a class="pagination-next" href="'.$url.($pagina+1).'/">Siguiente</a>
						';
				}

				$tabla.='</nav>';
				return $tabla;
		}
	}
?>