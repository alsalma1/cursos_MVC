<?php
require_once "models/alumno.php";
class AlumnoController{
    public function loginAlumno(){
        if($_POST){
            $alumno = new Alumno();
            $email = $_POST['email'];
            $passwd = $_POST['passwd'];
            //Si existe el usuario 
            if($alumno->existeAlumno($email,$passwd)==true){
                //Crear variables de sessión 
                $_SESSION['alumno'] = $email;
                require_once "views/alumno/menuAlumno.php";
            }
            else{
                ?>
                <script>alert("Email o contraseña incorrectos!")</script>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=alumno&action=loginAlumno">
                <?php
            }
        }
        else{
            require_once "views/alumno/formAlumno.php";
        }
    }

    public function mostrarMenu(){
        if(isset($_SESSION['alumno'])){
            require_once "views/alumno/menuAlumno.php";
        }
        else{
            alumnoNoLogeado();
        }
    }

    public function formCrearAlumno(){
        require_once "views/alumno/crearCuenta.php";
    }

    public function crearCuenta(){
        if(isset($_POST)){
            $alumno = new Alumno();
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
            $alumno->setDni($_POST['dniAl']);
            $alumno->setEmail($_POST['email']);
            $resultado = $alumno->datosDuplicados();
            
            //Controlar la entrada duplicada del DNI
            if($resultado==0){
                $alumno->setDni($_POST['dniAl']);
                $alumno->setNombre($_POST['nombreAl']);
                $alumno->setApellidos($_POST['apeAl']);
                $alumno->setEdad($_POST['edad']);
                $alumno->setEmail($_POST['email']);
                $alumno->setContrasenya($_POST['dniAl']);
                $alumno->setContrasenya($_POST['passAl']);
                $alumno->setFoto($ruta);
                //---------------------------------------------------------------------------//
                //Formato del DNI y email tienen que ser validos
                if(comprobarDni($_POST['dniAl'])==false){
                    ?>
                    <script>alert("Formato del DNI es inválido!")</script>
                    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=alumno&action=formCrearAlumno">
                    <?php
                }
                //Si esta todo correcto se crea la cuenta
                else{
                    $alumno->crearCuenta();
                    ?>
                    <script>alert("Cuenta creada correctamente! Ya puedes logear")</script>
                    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=alumno&action=loginAlumno">
                    <?php
                }

            }
            //Si ya existe una cuenta con el mismo email o DNI 
            else{
                ?><script>alert('Ya existe una cuenta con el mismo DNI o Email!')</script>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=alumno&action=formCrearAlumno">
                <?php
            }

        }
    }
    //Cerrar sesion
    public function salir(){
        $salir = new Alumno;
        $salir->salir();
        header("Location: index.php?controller=alumno&action=loginAlumno");

    }
}
?>