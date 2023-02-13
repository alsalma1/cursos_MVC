<a href="index.php"><img class="logo" src="pic/logoN.png" alt="" /></a>
<h1 class="T1">Area profesor</h1>
<div id="divf">
    <img class="img1" src="pic/img1.png" alt="">
    <form action="index.php?controller=profesor&action=loginProfesor" method="POST">
        <input class="inp1" type="text" name="dni" placeholder=" DNI" maxlength="9" required/><br><br>
        <input class="inp2" type="password" name="passwd" placeholder=" Password" required/><br><br>
        <input type="submit" name="enviar" value="Aceptar"/>
    </form>
</div>