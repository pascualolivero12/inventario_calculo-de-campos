<?php
  $page_title = 'Agregar producto';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $all_categories = find_all('categories');
  $all_photo = find_all('media');
  $all_proveedor = find_all('proveedor');
  $all_producto = find_all('products');
?>
<?php
 if(isset($_POST['add_product'])){
   $req_fields = array('codigo','descripcion','categoria','cantidad','compras','ventas','proveedor' );
  
   validate_fields($req_fields);
   if(empty($errors)){
    $p_cod  = remove_junk($db->escape($_POST['codigo']));
     $p_name  = remove_junk($db->escape($_POST['descripcion']));
     $p_cat   = remove_junk($db->escape($_POST['categoria']));
     $p_qty   = remove_junk($db->escape($_POST['cantidad']));
     $p_pro   = remove_junk($db->escape($_POST['proveedor']));
     $p_buy   = remove_junk($db->escape($_POST['compras']));
     $p_sale  = remove_junk($db->escape($_POST['ventas']));
     if (is_null($_POST['foto']) || $_POST['foto'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['foto']));
     }
    
     $date    = make_date();
   //consulta para ver si el codigo es duplicado en una columna
   
 
  if(columnExistsinTable('products','codigo',$p_cod)==false){
 
 
 
     $query  = "INSERT INTO products (";
     $query .=" codigo,name,quantity,buy_price,sale_price,categorie_id,media_id,date,id_proveedor";
     $query .=") VALUES ('{$p_cod}',";
     $query .=" '{$p_name}', '{$p_qty}', '{$p_buy}', '{$p_sale}', '{$p_cat}', '{$media_id}', '{$date}','{$p_pro}'";
     $query .=")";
    
     
   
      
      
     if($db->query($query)){
       $session->msg('s',"Producto agregado exitosamente. ");
       redirect('add_product.php', false);
     }else{
       $session->msg('d',' Lo siento, registro falló.');
       redirect('add_product.php', false);
     }

    }else{
      $session->msg('d',' Lo siento, Codigo ya existe.');
       redirect('add_product.php', false);

     }

 }else{
     $session->msg("d", $errors);
     redirect('add_product.php',false);
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
  <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar producto</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_product.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="codigo" placeholder="Codigo">
               </div>
               <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="descripcion" placeholder="Descripcion">
               </div>
                
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4">
                    <select class="form-control" name="categoria">
                      <option value="">Selecciona una categoría</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <select class="form-control" name="foto">
                      <option value="">Selecciona una imagen</option>
                    <?php  foreach ($all_photo as $photo): ?>
                      <option value="<?php echo (int)$photo['id'] ?>">
                        <?php echo $photo['file_name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <select class="form-control" name="proveedor">
                      <option value="">Selecciona una proveedor</option>
                    <?php  foreach ($all_proveedor as $proveedor): ?>
                      <option value="<?php echo (int)$proveedor['id'] ?>">
                        <?php echo $proveedor['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                     </span>
                     <input type="number" class="form-control" name="cantidad" placeholder="Cantidad">
                  </div>
                 </div>
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-usd"></i>
                     </span>
                     <input type="number"step="0.01" class="form-control" name="compras" placeholder="Precio de compra">
                    <!-- <span class="input-group-addon">.00</span>-->
                  </div>
                 </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input type="number"  step="0.01"class="form-control" name="ventas" placeholder="Precio de venta">
                      <!--<span class="input-group-addon">.00</span>-->
                   </div>
                  </div>
               </div>
              </div>
              <button type="submit" name="add_product" class="btn btn-danger">Agregar producto</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
