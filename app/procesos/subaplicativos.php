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

    <?php foreach($response as $key=>$value): ?>
	  <p class="text-center" id="proceso<?php echo $key; ?>">
      <strong>ID</strong>: <?php echo $value["ID"]; ?> <strong>Subaplicativo</strong>: <?php echo $value["NOMBRE"]; ?> <br/> <strong>RA: </strong> <?php echo $value["RA"]; ?><a id="link" href="editRA.php?id_sub=<?php echo $value["ID"]; ?>">(Editar RA)</a>
    </p>
    <?php
    if( $_SESSION['c'] == "1"){
      revisado($value["ID"]);
    }
    ?>
    <div id="subtitle">
    <a class="button secondary" href="index.php">Volver</a>
  </div>
  <p id="explicativo">En estas listas se muestran las relaciones existentes entre el subaplicativo seleccionado y los canales y servicios de cadena de pago. Para actualizar esta información, que se encuentra almacenada y actualizada  en la herramienta CMDB, de la Subgerencia de Integración de Servicios Tecnológicos, se solicita al Responsable su revisión.
  <br /><strong>Acciones:</strong>
  <br />Si desea cambiar el RA de dicho subaplicativo, presionar el link junto al nombre del RA (Solo se permite la edición del RA).
  <br />Si debe quitar una relación del subaplicativo (Canal o servicio) marcar la acción "Eliminar".
  <br />*Ninguna acción afecta directamente la base de la CMDB.</p>
  		<div class="servicios" id="servicios" >
        <h4>Servicios</h4> <a href="agregar_servicio.php?id=<?php echo $value['ID']?>" title="" class="button">Agregar</a>
        <table id="servicios<?php echo $key; ?>" name="<?php echo $value['ID'] ?>">
          <thead>
            <tr>
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
    <div class="canales" >
        <h4>Canales</h4> <a href="agregar_canal.php?id=<?php echo $value['ID']?>" title="" class="button">Agregar</a>
        <table id="canales<?php echo $key; ?>" name="<?php echo $value['ID'] ?>">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
    </div>
    <hr>
    <?php endforeach; ?>
    </div>

</body>
<?php
include('../Layout/Footer.php');
?>

</html>
