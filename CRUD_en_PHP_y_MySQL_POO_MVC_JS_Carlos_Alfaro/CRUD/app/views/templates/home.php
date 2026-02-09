<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once "./app/views/components/head.php"; ?>
</head>
<body>

</body>
    <h1>Ejercicio de CRUD en PHP y MySQL con POO, MVC y JS</h1>
    <?php
        use app\controllers\viewsController;

        $viewsController= new viewsController();
        $vista=$viewsController->obtenerVistasControlador($url[0]);

        if($vista=="login" || $vista=="404"){
            require_once "./app/views/templates/".$vista."-view.php";
        }else{
            require_once $vista;
        }
        require_once "./app/views/components/script.php";
    ?>
</html>