<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $proveedor = find_by_id('proveedor',(int)$_GET['id']);
  if(!$proveedor){
    $session->msg("d","ID de la categoría falta.");
    redirect('proveedor.php');
  }
?>
<?php
  $delete_id = delete_by_id('proveedor',(int)$proveedor['id']);
  if($delete_id){
      $session->msg("s","Proveedor eliminado");
      redirect('proveedor.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('proveedor.php');
  }
?>