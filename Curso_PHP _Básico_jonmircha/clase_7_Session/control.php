<?php
    $user = "guille";
    $pass = "123456";
    $user_send = $_POST["nombre"];
    $pass_send = $_POST["password"];

    if ($user_send == $user && $pass_send == $pass) {
        session_start();
        $_SESSION["autentificado"] = true;
        $_SESSION["usuario"] = $user_send;
        header("Location: archivo_protegido.php");
    } else {
        header("Location: index.php?error=true");
    }
?>