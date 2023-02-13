<?php
require_once "views/general/menuGestProf.php";
?>
<h4 class="rol"><?php echo $_SESSION['admin'].": Administrador" ?></h4>
<a href="index.php"><img class="logo" src="pic/logoN.png" alt="" /></a>
<h1 class='lc'>Listado profesores</h1>
<!-- -----------------------Buscador------------------------------- -->
<form class="busc" action="index.php?controller=profesor&action=mostrarProfesores" method=POST>
    <input type="text" name="buscador" placeholder="Search by name"/>
    <input class="bus" type="submit" name="buscar" value="Buscar"/>
</form>

<!-- Imprimir la tabla -->
<table class="Tcur">
    <tr class="tr">
        <th>DNI</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Nombre usuario</th>
        <th>Titúlo academico</th>
        <th>Fotografía</th>
        <th>Editar</th>
        <th>Estado</th>
    </tr>
    <?php
    
    foreach($rows as $row){?>
        
        <tr>
            <!-- Generar la tabla con los valores  -->
            <td><?php echo $row['DNI'] ?></td>
            <td><?php echo $row['nombre'] ?></td>
            <td><?php echo $row['apellidos'] ?></td>
            <td><?php echo $row['NombreUsu'] ?></td>
            <td><?php echo $row['titulo_academico'] ?></td>
            <td>
                <img class="picture" src="<?php echo $row['fotografia'] ?>" alt=""/>
            </td>

            <td>
                <a href="index.php?controller=profesor&action=datosProfesor&dniP=<?php echo $row['DNI']?>"><img class="edit" src="pic/datos.png"></a>
                <a href="index.php?controller=profesor&action=fotoProfesor&dniP=<?php echo $row['DNI']?>"><img class="edit" src="pic/image.png"></a>
            </td><?php
            //Si el estado es 1 , esta activado y muestra la foto de activado
            if($row['estadop']==1){?>
                <td>
                    <a href="index.php?controller=profesor&action=desactivar&dniP=<?php echo $row['DNI']?>"><img class="act" src="pic/activado.png"></a>
                </td><?php
            }
            else{?>
                <td>
                    <a href="index.php?controller=profesor&action=activar&dniP=<?php echo $row['DNI'] ;?>"><img class="act" src="pic/desactivado.png"></a>
                </td><?php
            }
            ?>
        </tr>
    <?php
    }
    ?>
</table>