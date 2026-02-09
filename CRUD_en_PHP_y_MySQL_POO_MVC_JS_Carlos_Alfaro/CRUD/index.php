<?php

    require_once "./config/app.php";
    require_once "./autoload.php";
    require_once "./app/views/components/session_start.php";

    $url_query_params = $_GET['views'] ?? ltrim($_SERVER['REQUEST_URI'] ?? '', '/');

#    $url_query_params = $_GET['views'] ; //es views, xq asi lo definimos al query params en .htaccess

    if(isset($url_query_params)){
        $url=explode("/", $url_query_params); // explode es similar a slice en javascript
    }else{
        $url=["login"];
    }
?>

<?php require_once "./app/views/templates/home.php"; ?>