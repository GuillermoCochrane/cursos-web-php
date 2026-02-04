<?php
//se pone ; al final de cada linea, xq cuando compilamos el codigo, se concatena todos los comandos
require_once "constants.php";
require_once "functions.php";
/* 
require vs require_once: 
require_once solo carga el archivo una vez, 
require carga el archivo una vez y luego lo vuelve a cargar cada vez que se ejecuta la función.

require vs include: 
include carga el archivo , pero no devuelve fatak error si el archivo no existe.

include vs include_once:
similar a require y require_once, pero no devuelve error si el archivo no existe.
 */
$data = get_data(API_URL);
$until_message = get_until_message($data["days_until"]);
?>
<?php //importamos las secciones del archivo head.php, styles.php y main.php ?>
<?php //require_once "sections/head.php"; ?>
<?php //require_once "sections/styles.php"; ?>
<?php //require_once "sections/main.php"; ?>

<?php //renderizamos las secciones del archivo head.php, styles.php y main.php ?>
<?php render_template("head", $data); //podemos pasarle solo ["title" => $data["title"]] en lugar de $data ?>
<?php render_template("styles"); ?>
<?php render_template("main", 
  array_merge( //array_merge fusiona los arrays que se pasan como argumentos en un nuevo array, similar [...a, ...b] en JS
  $data, 
  ["until_message" => $until_message]
  )); ?>