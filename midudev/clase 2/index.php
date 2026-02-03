<?php
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

require_once "sections/head.php";
require_once "sections/styles.php";
require_once "sections/main.php"; 
?>