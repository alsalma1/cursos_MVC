<ul class="vertical-menu">
    <li>
        <a href="#"><img src="pic/menu.png" alt=""></a>
        <ul>
        <li><a href="index.php?controller=profesor&action=mostrarMenu">Ver menú</a></li>
            <li><a href="index.php?controller=profesor&action=mostrarProfesores">Ver profesores</a></li>
            <li><a href="index.php?controller=admin&action=salir">Cerrar sesión</a></li>
        </ul>
    </li>
</ul>
<h4 class="rol"><?php echo $_SESSION['admin'].": Administrador" ?></h4>
<a href="index.php"><img class="logo" src="pic/logoN.png" alt="" /></a>
<h1 class='lc'>Editar profesor</h1>
<!-- -************************************************************************************************* -->
<form class="formGrid" action="index.php?controller=profesor&action=editarDatos" method="POST" enctype="multipart/form-data">  
    <div class="grid">
        <?php
        foreach($datos as $data){?>
            <div>
                <label for="dni">DNI </label>
                <input type="text" name="dni" value="<?php echo $data['DNI'] ?>" readonly required />
            </div>

            <div>
                <label for="nombreU">Nombre usuario </label> 
                <input type="text" name="nombreU" value="<?php echo $data['NombreUsu']?>" required>
            </div>

            <div>
                <label for="nombre">Nombre </label>
                <input type="text" name="nombre" value="<?php echo $data['nombre']?>" required>
            </div>

            <div>
                <label for="ape">Apellidos </label>
                <input type="text" name="ape" value="<?php echo $data['apellidos']?>" required>
            </div>

            <div>
                <label for="ta">Título académico </label>
                <input type="text" name="ta" value="<?php echo $data['titulo_academico']?>" required/>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="div_enviar">
        <input class="enviar" type="submit" name="Modificar" value="Modificar"/>
    </div>
</form>