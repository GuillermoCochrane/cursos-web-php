<?php

    require_once "./config/app.php";
    require_once "./autoload.php";

    $url_query_params = $_GET['views'];

    if(isset($url_query_params)){
        $url=explode("/", $url_query_params); // explode es similar a slice en javascript
    }else{
        $url=["login"];
    }

?>