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
<form class="busc" action="index.php?controller=matricula&action=misCursos" method=POST>
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
        <th>Nota</th>
        <th></th>
    </tr>
<?php
// Imprimir los valores de las otras filas desde la tabla 'cursos'
    foreach($cursos as $curso){?>
        <tr>
            <td><?php echo $curso['codigo'] ?></td>
            <td><?php echo $curso['nombreC'] ?></td>
            <td><?php echo $curso['descripcion'] ?></td>
            <td><?php echo $curso['horas'] ?></td>
            <td><?php echo $curso['fechaInicio'] ?></td>
            <td><?php echo $curso['fechaFinal'] ?></td>
            <td><?php echo $curso['profesor']." - ".$curso['nombre'] ?></td>
            <td>
                <?php 
                if($curso['nota']==NULL){
                    echo "-----";
                }
                else{echo $curso['nota'];}
                
                ?>
            </td>
            <td class="matricular"><a href="index.php?controller=matricula&action=darBaja&codi=<?php echo $curso['codigo'] ?>">Desmatricularme</a></td>  
        </tr>
    <?php
    }
    ?>
</table>