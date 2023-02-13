<!-- Menu -->
<ul class="vertical-menu">
    <li>
        <a href="#"><img src="pic/menu.png" alt=""></a>
        <ul>
            <li><a href="index.php?controller=alumno&action=mostrarMenu">Ver menu</a></li>
            <li><a href="index.php?controller=alumno&action=salir">Cerrar sesión</a></li>
        </ul>
    </li>
</ul>
<a href="index.php"><img class="logo" src="pic/logoN.png" alt="" /></a>
<!-- ---------------- Buscador --------------------->
<form class="busc" action="index.php?controller=curso&action=cursosDisponibles" method=POST>
    <input type="text" name="buscador" placeholder="Search by name"/>
    <input class="bus" type="submit" name="enviar" value="Buscar"/>
</form>
<!-- ---------------------------------------------- -->
<table class="Tcur">
    <tr class="tr">
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Horas</th>
        <th>Fecha inicial</th>
        <th>Fecha final</th>
        <th>Profesor</th>
        <th></th>
    </tr>
<?php
// Imprimir los valores de las otras filas desde la tabla 'cursos'
    foreach($cursos as $row){
        ?>
        <tr>
        <td><?php echo $row['codigo'] ?></td>
        <td><?php echo $row['nombreC'] ?></td>
        <td><?php echo $row['descripcion'] ?></td>
        <td><?php echo $row['horas'] ?></td>
        <td><?php echo $row['fechaInicio'] ?></td>
        <td><?php echo $row['fechaFinal'] ?></td>
        <td><?php echo $row['nombre']." - ".$row['apellidos'] ?></td>
        <td class="matricular"><a href="index.php?controller=matricula&action=darAlta&codi=<?php echo $row['codigo'] ?>">Matricularme</a></td>  
    </tr>
    <?php
    }
    ?>
</table>