<?php
# valida si existe la cookie y redirecciona según su valor.
$cookie = $_COOKIE["selected_language"];
if (!isset($cookie)) {
    header("Location: index.php");
} else if ($cookie == "es") {
    header("Location: spanish.php");
} else if ($cookie == "en") {
    header("Location: english.php");
}
?>