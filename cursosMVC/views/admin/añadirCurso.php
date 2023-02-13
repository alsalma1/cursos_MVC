<?php 
require_once "views/general/menuGestCursos.php";
?>
<h4 class="rol"><?php echo $_SESSION['admin'].": Administrador" ?></h4>
<a href="index.php"><img class="logo" src="pic/logoN.png" alt="" /></a>
<h1 class='lc'>Añadir curso</h1>

<form class="formGrid" action="index.php?controller=curso&action=añadirCurso" method="POST" >  
<div class="grid">
    <div>
        <label for="nombreC">Nombre </label>
        <input type="text" name="nombreC"  required />
    </div>

    <div>
        <label for="fechaI">Fecha inicio </label>
        <input type="date" name="fechaI" required />
    </div>

    <div>
        <label for="descri">Descripción </label>
        <textarea name="descri" maxlength="50" ></textarea>
    </div>
    
    <div>
        <label for="fechaF">Fecha final </label>
        <input type="date" name="fechaF"required />
    </div>

    <div>
        <label for="horas">Horas </label>
        <input type="Number"  max="5000" name="horas" maxlength="2" required />
    </div>

    <div>
        <label for="prof">Profesor </label>
        <select name="prof" id="prof" required>
            
            <?php
            //Visualizar los profesores en lista desplegable
            foreach($activos as $activo){
                ?>
                <option value="<?php echo $activo['DNI']?>"><?php echo $activo['nombre']?></option>
                <?php
            }
            ?>
        </select>
    </div>
</div>
<div class="div_enviar">
    <input class="enviar" type="submit" name="enviar" value="Aceptar"/>
</div>
</form>