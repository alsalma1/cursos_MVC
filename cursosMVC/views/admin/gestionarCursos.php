<?php
require_once "views/general/menuGestCursos.php";
?>
<h4 class="rol"><?php echo $_SESSION['admin'].": Administrador" ?></h4>
<a href="index.php"><img class="logo" src="pic/logoN.png" alt="" /></a>
<h1 class='lc'>Listado cursos</h1>
<!-- -----------------------Buscador------------------------------- -->
<form class="busc" action="index.php?controller=curso&action=mostrarCursos" method=POST>
    <input type="text" name="buscador" placeholder="Search by name"/>
    <input class="bus" type="submit" name="enviar" value="Buscar"/>
</form>
<!-- Imprimir la tabla -->
<table class="Tcur">
    <tr class="tr">
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Horas</th>
        <th>Fecha inicial</th>
        <th>Fecha final</th>
        <th>Profesor</th>
        <th>Modificar</th>
        <th>Estado</th>
    </tr>
    <?php
    
    foreach($rows as $row){?> 
        <tr>
            <td><?php echo $row['codigo'] ?></td>
                <td><?php echo $row['nombreC'] ?></td>
                <td><?php echo $row['descripcion'] ?></td>
                <td><?php echo $row['horas'] ?></td>
                <td><?php echo $row['fechaInicio'] ?></td>
                <td><?php echo $row['fechaFinal'] ?></td><?php
                
                //Si el profesor esta desactivado
                if($row['estadop']==0){?>
                    <td>No hay profesor</td><?php
                }
                else{?>
                    <td>
                        <?php echo $row['nombre']." ".$row['apellidos'] ?>
                    </td><?php
                }

                ?>
                <td>
                    <a href="index.php?controller=curso&action=FormModificarCurso&codi=<?php echo $row['codigo']?>"><img class="edit" src="pic/modificar.png"></a>
                </td>
                <?php
            if($row['Estado']==1){?>
                <td>
                <a href="index.php?controller=curso&action=desactivar&codi=<?php echo $row['codigo'] ;?>"><img class="act" src="pic/activado.png"></a>
                </td><?php
            }
            else{?>
                <td>
                <a href="index.php?controller=curso&action=activar&codi=<?php echo $row['codigo'] ;?>"><img class="act" src="pic/desactivado.png"></a>
                </td><?php
            }  
            ?>
        </tr>
    <?php
    }
    ?>
</table>
     