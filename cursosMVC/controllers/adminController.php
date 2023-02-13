<?php
require_once "models/admin.php";
class AdminController{
    public function mostrarPaginaPrincipal(){
        require_once "views/general/paginaPrincipal.php";
    } 
    
    public function loginAdmin(){
        if($_POST){
            $admin = new Admin();
            $user = $_POST['admin'];
            $passwd = $_POST['passwd'];
            //Si existe el usuario 
            if($admin->existeAdmin($user,$passwd)==true){
                //Crear variables de sessión 
                $_SESSION['admin'] = $user;
                require_once "views/admin/menu.php";
            }
            else{
                ?>
                <script>alert("Nombre de usuario o contraseña incorrectos!")</script>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=admin&action=loginAdmin">
                <?php
            }
        }
        else{
            require_once "views/admin/formAdmin.php";
        }
    }

    public function mostrarMenu(){
        if(isset($_SESSION['admin'])){
            require_once "views/admin/menu.php";
        }
        else{
            adminNoLogeado();
        }
    }
    //Cerrar sesion
    public function salir(){
        $salir = new Admin;
        $salir->salir();
        header("Location: index.php?controller=admin&action=loginAdmin");

    }
}
?>