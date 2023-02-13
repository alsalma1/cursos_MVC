<?php
require_once "models/Matricula.php";
class MatriculaController{
    public function darAlta(){
        if(isset($_SESSION['alumno'])){
            $matricula = new Matricula();
            if(isset($_GET['codi'])){
                $curso = $_GET['codi'];
                $alumno = $_SESSION['alumno'];
                $matricula->setIdCurso($curso);
                $matricula->setEmailAlumno($alumno);
                $matricula->darAlta();
                ?>
                <script>alert("Te has dado la alta correctamente!")</script>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=curso&action=cursosDisponibles">
                <?php
            }
        }
        else{
            alumnoNoLogeado();
        }
    }

    public function misCursos(){
        if(isset($_SESSION['alumno'])){
            $matricula = new Matricula();
            require_once "models/Curso.php";
            $curso = new Curso();
            if(isset($_POST['buscador'])){
                $curso->setNombreCurso($_POST['buscador']);
                $cursos = $curso->buscarMisCursos($_SESSION['alumno']);
            }
            else{
                $cursos=$matricula->misCursos(); 
            }
            require_once "views/alumno/misCursos.php";
        }
        else{
            alumnoNoLogeado();
        }
    }

    public function darBaja(){
        if(isset($_SESSION['alumno'])){
            $cursos = new Matricula();
            require_once "models/Curso.php";
            $curso = new Curso();
            $email = $_SESSION['alumno'];
            if(isset($_GET['codi'])){
                $codigo = $_GET['codi'];
                $cursos->setEmailAlumno($email);
                $cursos->setIdCurso($codigo);
                $curso->setId($codigo);
                $cursoAcabado = $curso->cursoSeleccionado();
                foreach($cursoAcabado as $curso){
                    //Si el curso ya se ha acabado , no se puede desmatricular
                    if($curso['fechaFinal']<date('Y-m-d')){
                        ?>
                        <script>alert("El curso ya se ha acabado , no puedes desmatricularte!")</script>
                        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=matricula&action=misCursos">
                        <?php
                    }
                    else{
                        $cursos->darBaja();
                        $cursos=$cursos->misCursos();
                        ?>
                        <script>alert("Te has hecho la baja correctamente!")</script>
                        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=matricula&action=misCursos">
                        <?php
                    }
                }
            }
        }
        else{
            alumnoNoLogeado();
        }
    }

    public function alumnosMatriculados(){
        if(isset($_SESSION['profesor'])){
            $matricula = new Matricula();
            if(isset($_GET['codi'])){
                $codigo = $_GET['codi'];
                $matricula->setIdCurso($codigo);
                $alumnos = $matricula->alumnosMatriculados();
                require_once "views/profesor/alumnosMatriculados.php";
                
            }
        }
        else{
            profesorNoLogeado();
        }
    }

    public function ponerNota(){
        if(isset($_SESSION['profesor'])){
            $matricula = new Matricula();
            require_once "models/Curso.php";
            $curso = new Curso();
            if(isset($_GET['codi'])){
                $email=$_GET['email'];
                $codigo=$_GET['codi'];
                $curso->setId($_GET['codi']);
                $cursos = $curso->cursoSeleccionado();
                foreach($cursos as $curso){
                    //Si el curso se ha ahacabo , puede poner la nota
                    if($curso['fechaFinal'] < date('Y-m-d')){
                        require_once "views/profesor/ponerNota.php";
                    }
                    //El curso aun no se ha acababo
                    else{
                        ?>
                        <script>alert("No puedes poner nota si el curso no se ha acabado")</script>
                        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=matricula&action=alumnosMatriculados&codi=<?php echo $codigo ?>">
                        <?php
                    }
                }
            }
        }
        else{
            profesorNoLogeado();
        }
    }

    public function insertarNota(){
        if(isset($_SESSION['profesor'])){
            if(isset($_POST)){
                $email = $_POST['email'];
                $codigo = $_POST['codi'];
                $nota = $_POST['nota'];
                $matricula = new Matricula();
                $matricula->setEmailAlumno($email);
                $matricula->setIdCurso($codigo);
                $matricula->setNota($nota);
                $matricula->insertarNota();
                ?>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=matricula&action=alumnosMatriculados&codi=<?php echo $codigo ?>">
                <?php
            }
        }
        else{
            profesorNoLogeado();
        }
    }
}
?>