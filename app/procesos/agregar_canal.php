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
  $response = getResponsableSubaplicativo( $_SESSION['nombre'],$_GET["id"]);
  ?>

    <div id="container">
      <p class="text-center" id="proceso">
        <strong>ID</strong>: <?php echo $response[0]["ID"]; ?> <strong>Subaplicativo</strong>: <?php echo $response[0]["NOMBRE"]; ?> <br/> <strong>RA: </strong> <?php echo $response[0 ]["RA"]; ?>
      </p>
      <div id="subtitle">
        <h3>Canales</h3>
        <a class="button secondary" href="subaplicativos.php?id=<?php echo $_GET["id"];?>">Volver</a>
      </div>
        <p id="explicativo">Para incorporar un nuevo canal que este relacionado con dicho subaplicativo, se adjunta el listado total de canales del banco. Una vez identificado el canal seleccionar la acción agregar.
        <br />Puede utilizar el campo de busqueda para aligilizar la selección de los canales.
        <br />*Ninguna acción afecta directamente la base de la CMDB.</p>

      <div class="grid-container">
        <input type="text" id="myInput" onkeyup="myFunction('resultado-canal')" placeholder="Buscar">
      <table id="resultado-canal">
        <thead
        ><tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
      </table>
      </div>
    </div>
    <script src="../js/app.js"></script>

</body>
<?php
include('../Layout/Footer.php');
?>
</html>
