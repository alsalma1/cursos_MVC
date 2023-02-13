<?php
    function adminNoLogeado(){
        ?>
        <script>alert("No puedes ver esta pagina si no estas logeado!")</script>
        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=admin&action=loginAdmin">
        <?php
    }

    function alumnoNoLogeado(){
        ?>
        <script>alert("Tienes que loguearte para ver esta pagina!")</script>
        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=alumno&action=loginAlumno">
        <?php
    }

    function profesorNoLogeado(){
        ?>
        <script>alert("Tienes que loguearte para ver esta pagina!")</script>
        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=profesor&action=loginProfesor">
        <?php
    }

    function comprobarDni($dni) {
        $ExpReg = "/\d{8}[TRWAGMYFPDXBNJZSQVHLCKE]/";
        if(preg_match($ExpReg, $dni)){
            return true;
        }
        return false;
    }

?>

