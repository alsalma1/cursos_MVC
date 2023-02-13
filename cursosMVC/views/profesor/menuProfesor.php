<a href="index.php"><img class="logo" src="pic/logoN.png" alt="" /></a>
<p class="salir"><a href="index.php?controller=profesor&action=salir">Cerrar sesión</a></p>
<?php
    $num = $cursos->rowCount();
    ?>
    <form class="busc" action="index.php?controller=curso&action=cursosProfesor" method=POST>
        <input type="text" name="buscador" placeholder="Search by name"/>
        <input class="bus" type="submit" name="enviar" value="Buscar"/>
    </form>
    <?php
    if($num==0){
        //Si el profesor esta activado pero aun no tiene ningun curso asignado:
        echo "<h2 class='h2'><br>No se encuentra ningún resultado!</h2>";
    }
    else{?>

        <?php

        //Imprimir los datos de los cursos
        foreach($cursos as $curso){
            ?>
            <div class="contenedor">
                    <?php echo "<h1>".$curso['nombreC']."</h1>";?>
                <div class="curso">
                    <div>
                        <h3>Codigo </h3>
                        <?php echo $curso['codigo'];?>
                    </div>
                    
                    <div>
                        <h3>Descripción </h3>
                        <?php echo $curso['descripcion'];?>
                        <br><br>
                    </div>

                    <div>
                        <h3>Fecha inicio </h3>
                        <?php echo $curso['fechaInicio'];?>
                        <br><br>
                    </div>

                    <div>
                        <h3>Fecha final </h3>
                        <?php echo $curso['fechaFinal']?>
                        <br><br>
                    </div>
                   
                    <div>
                        <h3>Horas </h3>
                        <?php echo $curso['horas'];?>
                        <br><br>
                    </div>

                </div>
                <p class="alumn"><a href="index.php?controller=matricula&action=alumnosMatriculados&codi=<?php echo $curso['codigo'] ?>">Ver alumnos</p></a>
            </div>
            <?php
        }
    }