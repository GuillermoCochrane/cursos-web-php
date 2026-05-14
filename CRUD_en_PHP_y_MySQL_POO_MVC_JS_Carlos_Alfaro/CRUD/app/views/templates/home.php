<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once "./app/views/components/head.php"; ?>
</head>
<body>
    <?php
        use app\controllers\viewsController;
        use app\controllers\loginController;

        $insLogin = new loginController(); // Iniciamos el controlador de login
        $viewsController= new viewsController(); // Iniciamos el controlador de vistas
        $vista=$viewsController->obtenerVistasControlador($url[0]);

        if($vista=="login" || $vista=="404"){
            require_once "./app/views/templates/".$vista."-view.php";
        }else{

            # Cerrar sesion #
            if((!isset($_SESSION['id']) || $_SESSION['id']=="") || (!isset($_SESSION['usuario']) || $_SESSION['usuario']=="")){
                $insLogin->cerrarSesionControlador();
                exit();
            }

            require_once "./app/views/components/navbar.php";

            require_once $vista;
        }
        require_once "./app/views/components/script.php";
    ?>
</body>
</html>