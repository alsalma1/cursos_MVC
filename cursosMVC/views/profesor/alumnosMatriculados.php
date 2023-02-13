<ul class="vertical-menu">
    <li>
        <a href="#"><img src="pic/menu.png" alt=""></a>
        <ul>
            <li><a href="index.php?controller=curso&action=cursosProfesor">Ver cursos&nbsp</a></li>
            <li><a href="index.php?controller=profesor&action=salir">Cerrar sesión</a></li>
        </ul>
    </li>
</ul>
<a href="index.php"><img class="logo" src="pic/logoN.png" alt="" /></a>

<table class="Tcur">
    <tr class="tr">
        <th>DNI</th>
        <th>Email</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Edad</th>
        <th>Fotografía</th>
        <th>Nota</th>
        <th>Editar/Añadir</th>
    </tr>
    <?php
    
    foreach($alumnos as $alumno){
        ?>
    <tr>
        <!-- Generar la tabla con los valores  -->
        <td><?php echo $alumno['DNI'] ?></td>
        <td><?php echo $alumno['email'] ?></td>
        <td><?php echo $alumno['nombre'] ?></td>
        <td><?php echo $alumno['apellidos'] ?></td>
        <td><?php echo $alumno['edad'] ?></td>
        <td>
            <img class="picture" src="<?php echo $alumno['fotografia'] ?>" alt=""/>
        </td>
        <td>
            <?php 
            if($alumno['nota']==NULL){
                echo "--------";
            }
            else{echo $alumno['nota'];}
            
            ?>
        </td>
        <td>
            <a href="index.php?controller=matricula&action=ponerNota&email=<?php echo $alumno['email']?>&codi=<?php echo $alumno['codigo']?>"><img class="edit" src="pic/modificar.png"></a>
        </td>
    </tr>
    <?php
    }
    ?>
</table>