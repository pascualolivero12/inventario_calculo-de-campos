<?php
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>

<?php
 // Auto suggetion
    $html = '';
   if(isset($_POST['product_name']) && strlen($_POST['product_name']))
   {
     $products = find_product_by_title($_POST['product_name']);
     if($products){
        foreach ($products as $product):
           $html .= "<li class=\"list-group-item\">";
           $html .= $product['name'];
           $html .= "</li>";
         endforeach;
      } else {

        $html .= '<li onClick=\"fill(\''.addslashes().'\')\" class=\"list-group-item\">';
        $html .= 'No encontrado';
        $html .= "</li>";

      }

      echo json_encode($html);
   }
 ?>
 <?php
 // find all product
  if(isset($_POST['p_name']) && strlen($_POST['p_name']))
  {
    $product_title = remove_junk($db->escape($_POST['p_name']));
    if($results = find_all_product_info_by_title($product_title)){
        foreach ($results as $result) {


         
          $html .= "<tr>";
          $html .= "<td id=\"s_cod\">".$result['codigo']."</td>";
          $html .= "<td id=\"s_qty\">";
          $html .= "<input type=\"number\" class=\"form-control\" name=\"id_quantity\" value=\"1\" required>";
          $html  .= "</td>";
          $html .= "<td id=\"s_name\">".$result['name']."</td>";
          
          $html  .= "<td>";
          $html  .= "<input type=\"text\" class=\"form-control\" name=\"id_price\" value=\"{$result['sale_price']}\"  readonly=\"readonl\">";
          $html  .= "</td>";
          $html  .= "<td>";
          $html  .= "<input type=\"text\" class=\"form-control\" name=\"id_total\" value=\"{$result['sale_price']}\" readonly=\"readonl\" >";
          $html  .= "</td>";
         
          
           $html  .= "</tr>";
        }
    } 
    echo json_encode($html);
  }
 ?>
