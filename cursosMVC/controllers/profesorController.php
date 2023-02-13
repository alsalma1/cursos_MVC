<?php
require_once "models/profesor.php";
class ProfesorController{
    public function loginProfesor(){
        if($_POST){
            $profesor = new Profesor();
            $dni = $_POST['dni'];
            $passwd = $_POST['passwd'];
            //Si existe el usuario 
            if($profesor->existeprofesor($dni,$passwd)==true){
                $activos = $profesor->comprobarActivo($dni,$passwd);
                foreach($activos as $activo){
                    if($activo['estadop']==1){
                        //Crear variables de sessión 
                        $_SESSION['profesor'] = $dni;
                        require_once "models/Curso.php";
                        $curso = new Curso();
                        $curso->setProfesor($_SESSION['profesor']);
                        $cursos = $curso->cursosProfesorLogeado();
                        require_once "views/profesor/menuProfesor.php";
                    }
                    else{
                        ?>
                        <script>alert("No tienes permiso para entrar con esta cuenta!")</script>
                        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=profesor&action=loginProfesor">
                        <?php
                    }
                }
                

            }
            else{
                ?>
                <script>alert("DNI o contraseña incorrectos!")</script>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=profesor&action=loginProfesor">
                <?php
            }
        }
        else{
            require_once "views/profesor/formProfesor.php";
        }
    }

    public function mostrarProfesores(){
        if(isset($_SESSION['admin'])){
            $profesor = new Profesor();
            if(isset($_POST['buscador'])){
                $profesor->setNombre($_POST['buscador']);
                $rows = $profesor->buscar();
            }
            else{
                $rows = $profesor->mostrarTodos();
            }
            require_once "views/admin/gestionarProf.php";
        }
        else{
            adminNoLogeado();
        }
    }

    public function formAñadirProfesor(){
        if(isset($_SESSION['admin'])){
            require_once "views/admin/añadirProfesor.php";
        }
        else{
            adminNoLogeado();
        }
    }

    public function añadirProfesor(){
        if(isset($_SESSION['admin'])){
            if(isset($_POST)){
                require_once "models/profesor.php";
                $profesor = new Profesor();
                //----------------------------Imagen------------------------------------------//
                if (is_uploaded_file ($_FILES['archivo']['tmp_name'])){
                    $nombreDirectorio = "img/";
                    $archivo=$_FILES['archivo']['name'];
                    move_uploaded_file ($_FILES['archivo']['tmp_name'],$nombreDirectorio .$archivo );
                }
                else{
                    print ("No se ha podido subir el fichero\n");
                }
                $ruta = $nombreDirectorio.$archivo;
                //---------------------------------------------------------------------------//
                //------------------Obtener los datos enviados por el formulario-------------//
                $profesor->setDni($_POST['dni']);
                $resultado = $profesor->dniDuplicado();
                
                //Controlar la entrada duplicada del DNI
                if($resultado==0){
                    $profesor->setDni($_POST['dni']);
                    $profesor->setNombre($_POST['nombre']);
                    $profesor->setApellido($_POST['ape']);
                    $profesor->setTituloAcademico($_POST['ta']);
                    $profesor->setNombreUsu($_POST['nombreU']);
                    $profesor->setContrasenya($_POST['pass']);
                    $profesor->setFoto($ruta);
                    //---------------------------------------------------------------------------//
                    if(comprobarDni($_POST['dni'])==false){
                        ?>
                        <script>alert("Formato del DNI es inválido!")</script>
                        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=profesor&action=formAñadirProfesor">
                        <?php
                    }
                    else{
                        $profesor->insertar();
                    ?>
                        <script>alert("Se ha creado correctamente")</script>
                        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=profesor&action=mostrarProfesores">
                         <?php
                    }
                }
                else{
                    ?><script>alert('Ya existe este profesor!')</script>
                    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=profesor&action=formAñadirProfesor">
                    <?php
                }
            }
        }
        else{
            adminNoLogeado();
        }
    }

    public function desactivar(){
        if(isset($_SESSION['admin'])){
            $profesor = new Profesor();
            if(isset($_GET)){
                $dni = $_GET['dniP'];
                $profesor->setDni($dni);
                $profesor->desactivarProfesor();
                ?>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=profesor&action=mostrarProfesores">
                <?php
            }
        }
        //Si el admin no esta logeado , no puede ver las paginas
        else{
            adminNoLogeado();
        }
    }

    public function activar(){
        if(isset($_SESSION['admin'])){
            $profesor = new Profesor();
            if(isset($_GET)){
                $dni = $_GET['dniP'];
                $profesor->setDni($dni);
                $profesor->activarProfesor();
                ?>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=profesor&action=mostrarProfesores">
                <?php
            }
        }
        //Si el admin no esta logeado , no puede ver las paginas
        else{
            adminNoLogeado();
        }
    }

    public function datosProfesor(){
        if(isset($_SESSION['admin'])){
            $profesor = new Profesor();
            if(isset($_GET)){
                $dni = $_GET['dniP'];
                $profesor->setDni($dni);
                $datos = $profesor->datosProfesorEditar();
                require_once "views/admin/editarDatosProfesor.php";
            }
        }
        //Si el admin no esta logeado , no puede ver las paginas
        else{
            adminNoLogeado();
        }
    }

    public function editarDatos(){
        if(isset($_SESSION['admin'])){
            $profesor = new Profesor();
            if(isset($_POST)){
                $profesor->setDni($_POST['dni']);
                $profesor->setNombre($_POST['nombre']);
                $profesor->setApellido($_POST['ape']);
                $profesor->setTituloAcademico($_POST['ta']);
                $profesor->setNombreUsu($_POST['nombreU']);
                $profesor->editarDatos();
                ?>
                <script>alert("Datos modificados correctamente!")</script>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=profesor&action=mostrarProfesores">
                <?php
            }
        }
        else{
            adminNoLogeado();
        }
    }
    public function fotoProfesor(){
        $profesor = new Profesor();
        if(isset($_SESSION['admin'])){
            if(isset($_GET)){
                $dni = $_GET['dniP'];
                $datos = $profesor->modificarFoto();
                require_once "views/admin/cambiarFotoProfesor.php";
            }
        }
        //Si el admin no esta logeado , no puede ver las paginas
        else{
            adminNoLogeado();
        }
    }

    public function cambiarFoto(){
        if(isset($_SESSION['admin'])){
            $profesor = new Profesor();
            $dni = $_GET['dni'];
            if(isset($_POST)){
                $profesor->setDni($dni);
                //subir imagen
                if (is_uploaded_file ($_FILES['archivo']['tmp_name'])){
                    $nombreDirectorio = "img/";
                    $archivo=$_FILES['archivo']['name'];
                    move_uploaded_file ($_FILES['archivo']['tmp_name'],$nombreDirectorio .$archivo );
                }
                $ruta = $nombreDirectorio.$archivo;
                $profesor->setFoto($ruta);
                $profesor->modificarFoto();
                ?>
                <script>alert("Imagen modificada correctamente!")</script>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=profesor&action=mostrarProfesores">
                <?php
            }
        }
        else{
            adminNoLogeado();
        }
    }

    //Cerrar sesion
    public function salir(){
        $salir = new Profesor;
        $salir->salir();
        header("Location: index.php?controller=profesor&action=loginProfesor");

    }
}
?>