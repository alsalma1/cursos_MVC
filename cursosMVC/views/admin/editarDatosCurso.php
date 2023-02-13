<ul class="vertical-menu">
    <li>
        <a href="#"><img src="pic/menu.png" alt=""></a>
        <ul>
            <li><a href="index.php?controller=admin&action=mostrarMenu">Ver menú&nbsp</a></li>
            <li><a href="index.php?controller=curso&action=mostrarCursos">Ver cursos&nbsp</a></li>
            <li><a href="index.php?controller=admin&action=salir">Cerrar sesión</a></li>
        </ul>
    </li>
</ul>
<h4 class="rol"><?php echo $_SESSION['admin'].": Administrador" ?></h4>
<a href="index.php"><img class="logo" src="pic/logoN.png" alt="" /></a>
<h1 class='lc'>Modificar curso</h1>
<form class="formGrid" action="index.php?controller=curso&action=modificarCurso" method="POST">  
    <!------------------- Formulario con valores anteriores para modificar ------>
    <div class="grid">
        <?php
        foreach($datos as $row){?>
            <input type="hidden" name="codigo" value="<?php echo $row['codigo'] ?>">
            <div>
                <label for="nombreC">Nombre </label>
                <input type="text" name="nombreC" value="<?php echo $row['nombreC'] ?>" required />
            </div>

            <div>
                <label for="fechaI">Fecha inicio </label> 
                <input type="date" name="fechaI" value="<?php echo $row['fechaInicio'] ?>" required />
            </div>

            <div>
                <label for="descri">Descripción </label>
                <textarea name="descri" maxlength="20"><?php echo $row['descripcion']?></textarea>
            </div>

            <div>
                <label for="fechaF">Fecha final </label>
                <input type="date" name="fechaF" value="<?php echo $row['fechaFinal'] ?>" required />
            </div>

            <div>
                <label for="horas">Horas </label> 
                <input type="Number"  max="5000" name="horas" maxlength="2" value="<?php echo $row['horas'] ?>" required />
            </div>

            <div> 
                <label for="prof">Profesor </label>
                <select name="prof" id="prof">
                    <?php
                    foreach($activos as $activo){?>
                        <option value="<?php echo $activo['DNI']?>"><?php echo $activo['nombre']?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        <?php    
        }
        ?>
    </div>

    <div class="div_enviar">
        <input class="enviar" type="submit" name="Modificar" value="Modificar"/>
    </div>                
</form>