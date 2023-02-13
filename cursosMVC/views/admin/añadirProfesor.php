<?php
require_once "views/general/menuGestProf.php";
?>
<h4 class="rol"><?php echo $_SESSION['admin'].": Administrador" ?></h4>
<a href="index.php"><img class="logo" src="pic/logoN.png" alt="" /></a>
<h1 class='lc'>Añadir profesor</h1>

<form class="formGrid" action="index.php?controller=profesor&action=añadirProfesor" method="POST" enctype="multipart/form-data">  
    <div class= "grid">
        <div>
            <label for="dni">DNI </label>
            <input type="text" name="dni" maxlength="9" required />
        </div>

        <div>
            <label for="nombreU">Nombre usuario </label> 
            <input type="text" name="nombreU" required>
        </div>

        <div>
            <label for="nombre">Nombre </label>
            <input type="text" name="nombre" required>
        </div>

        <div>
            <label for="pass">Contraseña </label>
            <input type="password" name="pass" required>
        </div>

        <div>
            <label for="ape">Apellidos </label>
            <input type="text" name="ape" required>
        </div>

        <div>
            <label for="archivo">Fotografía </label>
            <input class="file" type="file" name="archivo" value="Selecciona un archivo" style="color:#4959ff" required>
        </div>

        <div>
            <label for="ta">Título académico </label>
            <input type="text" name="ta" required/>
        </div>
    </div>
    <div class="div_enviar">
        <input class="enviar" type="submit" name="enviar" value="Aceptar"/>
    </div>
</form>