<!doctype html>
<html class="no-js" lang="en">
<?php
include "Layout/Head.php";
?>
<body>
    <div id="intro">
        <div class="row">
            <div class="large-6 medium-6 large-offset-3 medium-offset-3 columns">
                <div id="sign-up">
                    <img src="img/logo-banco-estado.jpg" alt="BancoEstado" />
                    <center>Gestión de la Configuración</center>
                    <hr />
                    <label>Usuario</label>
                        <form action="ajax/login.php" method="post">
                        <input id="user" name="user" type="text" />
                        <label>Contraseña</label>
                        <input id="pass" name="pass" type="password" />
                        <button class="blue-btn">Iniciar sesión</button>
                        </form>
                        <?php
                            if(isset($_GET["login"])){
                                if($_GET["login"] == "error")
                                    echo "<strong><center style='color: red;'>Error usuario/contraseña</center></strong>";
                            }
                        ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
