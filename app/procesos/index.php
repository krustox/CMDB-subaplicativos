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
    $response = getResponsable( $_SESSION['nombre']);
     ?>

    <div id="container">

    <?php foreach($response as $key=>$value): ?>
	  <p class="text-center" id="proceso<?php echo $key; ?>">
      <strong>ID</strong>: <?php echo $value["ID"]; ?> <strong>Aplicativo</strong>: <?php echo $value["NOMBRE"]; ?> <strong>TRIPLETA</strong>: <?php echo $value["TRIPLETA"]; ?> <br/> <strong>AFA: </strong> <?php echo $value["AFA"]; ?>
    </p>
		<div class="aplicativo" id="aplicativo" >
      <p>La información expuesta corresponde a la recabada el año 2017 para "Mapa Aplicativo" en la cual se muestran los subaplicativos con sus respectivos responsables. Para actualizar esta información, que se encuentra almacenada y actualizada  en la herramienta CMDB, de la Subgerencia de Integración de Servicios Tecnológicos, se solicita su revisión.
      <br /><strong>Acciones:</strong>
	  <br />Si debe quitar un subaplicativo (Que ya no suyo) marcar la acción "Eliminar".
     <br />Si debe Asignar 'No Vigente' un subaplicativo marcar la acción "No Vigente".
     <br />Para relacionar un subaplicativo con sus respectivos canales o servicios marcar la acción "Ver Subaplicativo".
      <br />*Ninguna acción afecta directamente la base de la CMDB.</p>
        <h4>Subaplicativos</h4>
        <table id="subaplicaciones<?php echo $key; ?>" name="<?php echo $value['ID'] ?>,<?php echo $value['AFAS'] ?>">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>AFA</th>
              <th>RA</th>
              <th>Finalizado</th>
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
