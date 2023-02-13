<a href="index.php"><img class="logo" src="pic/logoN.png" alt="" /></a>
<h1 class='lc'>Crear mi cuenta</h1>

<form class="formGrid" action="index.php?controller=alumno&action=crearCuenta" method="POST" enctype="multipart/form-data">  
    <div class="grid">
        <div>
            <label for="dniAl">DNI </label>
            <input type="text" name="dniAl" maxlength="9"  required />
        </div>

        <div>
            <label for="nombreAl">Nombre </label>
            <input type="text" name="nombreAl" required>
        </div>
        <div>
            <label for="apeAl">Apellidos </label>
            <input type="text" name="apeAl" required>
        </div>
        <div>
            <label for="edad">Edad </label>
            <input type="Number" min="10" max="80" name="edad" required/>
        </div>
        <div>
            <label for="email">Email </label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label for="passAl">Contraseña </label>
            <input type="password" name="passAl" required>
        </div>
    
        <!---------------------- Insertar la foto -------------->
        <div>
            <label for="archivo">Fotografía </label>
            <input  type="file" name="archivo" value="" required>
            
        </div>
    </div>
    <div class="div_enviar">
        <input class="enviar" type="submit" name="enviar" value="Aceptar"/>
    </div>
</form>