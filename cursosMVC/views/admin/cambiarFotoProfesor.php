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
<h1 class='lc'>Modificar imagen</h1>
<!-- -************************************************************************************************* -->
<form class="mfoto" action="index.php?controller=profesor&action=cambiarFoto&dni=<?php echo $dni ?>" method="POST" enctype="multipart/form-data">  
    <div>
        <label for="archivo">Fotografía </label>
        <input type="file" name="archivo" value="<?php echo $fila['fotografia']?>" style="color:#4959ff" required/><br>
    </div>
    <input class="modi" type="submit" name="Modificar" value="Modificar"/>
</form> 