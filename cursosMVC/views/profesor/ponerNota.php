<!-- Menu -->
<ul class="vertical-menu">
    <li>
        <a href="#"><img src="pic/menu.png" alt=""></a>
        <ul>
            <li><a href="index.php?controller=curso&action=cursosProfesor">Ver cursos</a></li>
            <li><a href="index.php?controller=profesor&action=salir">Cerrar sesión</a></li>
        </ul>
    </li>
</ul>
<a href="principal.php"><img class="logo" src="pic/logoN.png" alt="" /></a>
<h1 class='lc'>Añadir o modificar nota</h1>

<form class="mfoto" action="index.php?controller=matricula&action=insertarNota"  method="POST">
    <div>
        <label for="nota">Nota </label>
        <div>
            <input type="Number" max="10" name="nota" value="" required />
        </div>
    </div>
    <input class="modi" type="submit" name="enviar" value="Aceptar"/>
    <input type="hidden" name ="email" value="<?php echo $email ?>"/>
    <input type="hidden" name="codi" value = "<?php echo $codigo ?>"/>
</form>