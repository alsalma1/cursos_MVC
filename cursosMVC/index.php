<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="views/proyecto.css" rel="stylesheet" type="text/css">
    <script src="views/admin/pedidos/pedidos.js"></script>
    <script src="views/cliente/libro/scripts.js"></script>
</head>
<body>
    <?php
        session_start();
        require_once "autoload.php";

        //Scripts
        include('views/scripts/scripts.php');
        //--------------------------------------------------------//
        
        if (isset($_GET['controller'])){
            $nombreController = $_GET['controller']."Controller";
        }
        else{
            $nombreController="adminController";
        }
        if (class_exists($nombreController)){
            $controlador = new $nombreController(); 
        if(isset($_GET['action'])){
            $action = $_GET['action'];
        }
        else{
            $action = "mostrarPaginaPrincipal";
        }
            $controlador->$action();   
        }else{
            echo "La pagina no existe";
        } 
    ?>
</body>
</html>