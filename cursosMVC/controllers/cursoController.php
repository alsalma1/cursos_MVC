<?php
require_once "models/curso.php";
class CursoController{
    public function mostrarCursos(){
        if(isset($_SESSION['admin'])){
            $curso = new Curso();
            if(isset($_POST['buscador'])){
                $curso->setNombreCurso($_POST['buscador']);
                $rows=$curso->buscar();
            }
            else{
                $rows = $curso->mostrarTodos();
            }
            require_once "views/admin/gestionarCursos.php";
        }
        else{
            adminNoLogeado();
        }
    }

    public function formAñadirCurso(){
        if(isset($_SESSION['admin'])){
            require_once "models/Profesor.php";
            $profesor = new Profesor();
            $activos = $profesor->profesoresActivos();
            require_once "views/admin/añadirCurso.php";
        }
        else{
            adminNoLogeado();
        }
    }

    public function añadirCurso(){
        if(isset($_SESSION['admin'])){
            $curso = new Curso();
            if(isset($_POST)){
                $curso->setNombreCurso($_POST['nombreC']);
                $resultado = $curso->nombreDuplicado();
                if($resultado == 0){
                    //Controlar la fecha de inicio y final del curso
                    if($_POST['fechaI'] >= $_POST['fechaF']){
                        ?>
                        <script>alert("La fecha inicio tiene que ser menor que la fecha final")</script>
                        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=curso&action=formAñadirCurso">
                        <?php
                    }
                    else{
                        $curso->setDescripcion($_POST['descri']);
                        $curso->setHoras($_POST['horas']);
                        $curso->setFechaInicio($_POST['fechaI']);
                        $curso->setFechaFinal($_POST['fechaF']);
                        $curso->setProfesor($_POST['prof']);
                        $curso->insertarCurso();
                        ?>
                        <script>alert("Se ha creado correctamente!")</script>
                        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=curso&action=mostrarCursos">
                        <?php
                    }

                }

                else{
                    ?>
                    <script>alert("Existe un curso con el mismo nombre , intenta otra vez!")</script>
                    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=curso&action=formAñadirCurso">
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
            $curso = new Curso();
            if(isset($_GET)){
                $dni = $_GET['codi'];
                $curso->setId($dni);
                $curso->desactivarCurso();
                ?>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=curso&action=mostrarCursos">
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
            $curso = new Curso();
            if(isset($_GET)){
                $curso->setId($_GET['codi']);
                $activos = $curso->activo();
                foreach($activos as $activo){
                    if($activo['estadop'] == 0){?>
                        <script>alert("No se puede activar el curso antes de asignarle un profesor")</script>
                    <?php
                    }
                    else{
                        $id = $_GET['codi'];
                        $curso->setId($id);
                        $curso->activarCurso();
                    }
                    ?>
                    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=curso&action=mostrarCursos">
                    <?php
                }
            }
        }
        //Si el admin no esta logeado , no puede ver las paginas
        else{
            adminNoLogeado();
        }
    }

    public function FormModificarCurso(){
        if(isset($_SESSION['admin'])){
            require_once "models/Profesor.php";
            $profesor = new Profesor();
            $curso = new Curso();
            if(isset($_GET)){
                $id = $_GET['codi'];
                $curso->setId($id);
                $datos = $curso->datosCurso();
                $activos = $profesor->profesoresActivos();
                require_once "views/admin/editarDatosCurso.php";
            }
        }
        //Si el admin no esta logeado , no puede ver las paginas
        else{
            adminNoLogeado();
        }

    }
    public function modificarCurso(){
        if(isset($_SESSION['admin'])){
            $curso = new Curso();
            if(isset($_POST)){
                $codi = $_POST['codigo'];
                if($_POST['fechaI'] >= $_POST['fechaF']){
                    ?>
                    <script>alert("La fecha inicio tiene que ser menor que la fecha final")</script>
                    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=curso&action=FormModificarCurso&codi=<?php echo $codi ?>">
                    <?php
                }
                else{
                    $curso->setId($_POST['codigo']);
                    $curso->setNombreCurso($_POST['nombreC']);
                    $curso->setDescripcion($_POST['descri']);
                    $curso->setHoras($_POST['horas']);
                    $curso->setFechaInicio($_POST['fechaI']);
                    $curso->setFechaFinal($_POST['fechaF']);
                    $curso->setProfesor($_POST['prof']);
                    $curso->modificarCurso();
                    ?>
                    <script>alert("Curso modificado correctamente!")</script>
                    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=curso&action=mostrarCursos">
                    <?php
                }
    
            }
        }
        else{
            adminNoLogeado();
        }
    }

    public function cursosDisponibles(){
        if(isset($_SESSION['alumno'])){
            $curso = new Curso();
            if(isset($_POST['buscador'])){
                $curso->setNombreCurso($_POST['buscador']);
                $cursos=$curso->buscarCursosDisponible();
            }
            else{
                $cursos = $curso->cursosDisponibles();
            }
            require_once "views/alumno/cursosDisponibles.php";
        }
        else{
            alumnoNoLogeado();
        }
    }

    public function cursosProfesor(){
        if(isset($_SESSION['profesor'])){
            $curso = new Curso();
            $curso->setProfesor($_SESSION['profesor']);
            if(isset($_POST['buscador'])){
                $curso->setProfesor($_SESSION['profesor']);
                $curso->setNombreCurso($_POST['buscador']);
                $cursos = $curso->buscarCursosPorfesor();
            }
            else{
                $cursos = $curso->cursosProfesorLogeado();
            }
            require_once "views/profesor/menuProfesor.php";
        }
        else{
            profesorNoLogeado();
        }
    }

}
?>