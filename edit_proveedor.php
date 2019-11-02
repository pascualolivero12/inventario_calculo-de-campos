<?php
  $page_title = 'Editar proveedor';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  //Display all catgories.
  $proveedor = find_by_id('proveedor',(int)$_GET['id']);
  if(!$proveedor){
    $session->msg("d","Missing proveedor id.");
    redirect('proveedor.php');
  }
?>

<?php
if(isset($_POST['edit_proveedor'])){
  $req_field = array('proveedor-name','proveedor-tel');
  validate_fields($req_field);
  $cots_name = remove_junk($db->escape($_POST['proveedor-name']));
  $cots_tel = remove_junk($db->escape($_POST['proveedor-tel']));
  if(empty($errors)){
        $sql = "UPDATE proveedor SET name='{$cots_name}', tel='{$cots_tel}'";
       $sql .= " WHERE id='{$proveedor['id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Proveedor actualizada con éxito.");
       redirect('proveedor.php',false);
     } else {
       $session->msg("d", "Lo siento, actualización falló.");
       redirect('proveedor.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('proovedor.php',false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
   <div class="col-md-5">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Editando <?php echo remove_junk(ucfirst($proveedor['name']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_proveedor.php?id=<?php echo (int)$proveedor['id'];?>">
           <div class="form-group">
               <input type="text" class="form-control" name="proveedor-name" value="<?php echo remove_junk(ucfirst($proveedor['name']));?>">
               <input type="text" class="form-control" name="proveedor-tel" value="<?php echo remove_junk(ucfirst($proveedor['tel']));?>">
           </div>
           <button type="submit" name="edit_proveedor" class="btn btn-primary">Actualizar proveedor</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>
