<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $categorie = find_by_id('proveedor',(int)$_GET['id']);
  if(!$categorie){
    $session->msg("d","ID del proveedores falta.");
    redirect('proveedor.php');
  }
?>
<?php
  $delete_id = delete_by_id('proveedor',(int)$categorie['id']);
  if($delete_id){
      $session->msg("s","Proveedores eliminado");
      redirect('proveedor.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('proveedor.php');
  }
?>
