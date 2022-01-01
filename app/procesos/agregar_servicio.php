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
        <h3>Servicios</h3>
          <a class="button secondary" href="subaplicativos.php?id=<?php echo $_GET["id"];?>">Volver</a>
      </div>
        <p id="explicativo">Para incorporar un nuevo servicio que este relacionado con dicho subaplicativo, se adjunta los servicios pertenecientes a cadena de pago. Una vez identificado el servicio seleccionar la acción agregar.
        <br />Puede utilizar el campo de busqueda para aligilizar la selección de los servicios.
        <br />*Ninguna acción afecta directamente la base de la CMDB.</p>

      <div class="grid-container">
        <input type="text" id="myInput" onkeyup="myFunction('resultado-servicio')" placeholder="Buscar">
      <table id="resultado-servicio">
        <thead
        ><tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Descripcion</th>
          <th>Canal</th>
          <th>Gestor</th>
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
