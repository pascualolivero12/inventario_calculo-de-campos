<?php
  $page_title = 'Lista de proveedores';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
  $all_provedores = find_all('proveedor')
?>
<?php
 if(isset($_POST['add_cots'])){
   $req_field = array('proveedor-name','proveedor-tele');
   validate_fields($req_field);
   
   if(empty($errors)){
   $proveedor_name = remove_junk($db->escape($_POST['proveedor-name']));
    $proveedor_tele = remove_junk($db->escape($_POST['proveedor-tele']));
  //funcion para ver si tenemos cplumna duplicada en la tabla
    if (columnExistsinTable('proveedor','name',$proveedor_name) == false){


      $sql  = "INSERT INTO proveedor (name,tel)";
      $sql .= " VALUES ('{$proveedor_name}','{$proveedor_tele}')";
     
      if($db->query($sql)){
        $session->msg("s", "Proveedor agregado exitosamente.");
        redirect('proveedor.php',false);
      } else {
        $session->msg("d", "Lo siento, registro falló");
        redirect('proveedor.php',false);
      }
  }else{
$session->msg("d", "El proveeedor ya existe");
     redirect('proveedor.php',false);

  }


   } else {
     $session->msg("d", $errors);
     redirect('proveedor.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>

  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
  </div>
   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar Proveedor</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="proveedor.php">
            <div class="form-group">
                <input type="text" class="form-control" name="proveedor-name" placeholder="Nombre del proveedor" required>
            </div>
                        <div class="form-group">
                <input type="tel" class="form-control" name="proveedor-tele" placeholder="Numero de telefono sin guiones " required>
            </div>
            <button type="submit" name="add_cots" class="btn btn-primary">Agregar Proveedor</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Lista de Proveedores</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th class="text-center" style="width: 50px;">Proveedores</th>
                    <th class="text-center" style="width: 50px;">Telefono</th>
                    <th class="text-center" style="width: 50px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_provedores as $cots):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($cots['name'])); ?></td>
                    <td><?php echo remove_junk(($cots['tel'])); ?></td>

                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_proveedor.php?id=<?php echo (int)$cots['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="delete_proveedor.php?id=<?php echo (int)$cots['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                        
                      </div>
                    </td>

                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
       </div>
    </div>
    </div>
   </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>