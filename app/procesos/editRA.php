<?php

include('../../ajax/validarSesion.php');
?>
<!DOCTYPE html>
<html>

<?php
include('../Layout/Head.php');
include('../Layout/Header.php');
?>

<body>

    <?php
    $response = getResponsableSubaplicativo( $_SESSION['nombre'],$_GET["id_sub"]);
     ?>

    <div id="container">
      <p class="text-center" id="proceso0">
        <strong>ID</strong>: <?php echo $response[0]["ID"]; ?> <strong>Subaplicativo</strong>: <?php echo $response[0]["NOMBRE"]; ?> <br/> <strong>RA: </strong> <?php echo $response[0]["RA"]; ?>
      </p>
      <div id="subtitle">
        <h3>Editar Subaplicativo</h3>
        <a class="button secondary" href="subaplicativos.php?id=<?php echo $_GET["id_sub"];?>">Volver</a>
      </div>
      <p id="explicativo">En este formulario se muestra la información relacionada con el subaplicativo, sin embargo solo se puede modificar el RA de este.
        <br /><strong>En el campo se debe ingresar el usuario (login) del responsable del aplicativo, en caso de ingresar el nombre completo el cambio no sera efectuado.</strong>
        <br />*Ninguna acción afecta directamente la base de la CMDB.</p>
        <div id="formularios">
            <form>
              <div>
                <label class="title">ID:</label>
                <label> <?php echo $response[0]["ID"]; ?></label>
              </div>
              <div>
                <label class="title">Nombre:</label>
                <label> <?php echo $response[0]["NOMBRE"]; ?></label>
              </div>
              <div>
                <label class="title">AFA:</label>
                <label> <?php echo $response[0]["AFA"]; ?></label>
              </div>
              <div>
                <label class="title">RA:</label>
                <input type="text" id="RA" name="RA" value="<?php echo $response[0]["RAS"]; ?>">
                <p id="error"></p>
              </div>
              <div>
                <label class="title">Vigente:</label>
                <label> <?php if($response[0]["VIGENTE"]==1){echo "SI";}else{echo "NO";} ?></label>
              </div>
              <div id="inputb">
                <a class="button" id="guardar" onclick="cambiarRA(<?php echo $response[0]["ID"]; ?>)" style="display: none">Guardar</a>
              </div>
            </form>
          </div>
    </div>

</body>
<?php
include('../Layout/Footer.php');
?>

</html>
