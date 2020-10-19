<?php
include('admin/config.php');

///////////////////////////////////inserting in cart////////////////////////////////

$errors = array();
if (isset($_POST['add_to_cart'])) {

  $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
  $name = isset($_POST['name']) ? $_POST['name'] : '';
  $image = isset($_POST['image']) ? $_POST['image'] : '';
  $quantity = 1;
  $price = isset($_POST['price']) ? $_POST['price'] : '';
  $netprice = $price * $quantity;

  if (sizeof($errors) == 0) {

    $sql = "INSERT INTO cart (id,name,image,quantity,price,netprice)VALUES ('" . $product_id . "','" . $name . "', '" . $image . "', '" . $quantity . "', '" . $price . "','" . $netprice . "')";

    if ($conn->query($sql) === TRUE) {
      // $message = "New record created successfully";
    } else {
      $errors[] = array('inputs' => 'forms', 'msg' => $conn->error);
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}

///////////////////////////////////deletion in cart////////////////////////////////
$del_id = $_GET['id'];
if ($del_id != "") {
  $sql = "DELETE FROM cart WHERE id=$del_id";

  if ($conn->query($sql) === TRUE) {
    //echo "Record deleted successfully";
    $del_id = "";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}

////////////////////////////////////displaying products in the cart.php  AND in the top cart icon//////////////////////////////

$sql = "SELECT * FROM cart";
$result = $conn->query($sql);
$errors = array();
$cnt=0;
$total=0;

if (sizeof($errors) == 0) {

  if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
      $cnt=$cnt+1;//for counting items in cart
      $name = $row["name"];
      $price = $row["price"];
      $quantity = $row["quantity"];
      $product_id = $row["id"];
      $image = $row["image"];
      $netprice = $row["netprice"];
      $int_cast_netprice = (int)$netprice;
      gettype($total);
      $total=$total+$int_cast_netprice;
      
      $cart_icontable .= '
      <li>
        <a class="aa-cartbox-img" href="cart.php"><img src="admin/resources/productimage/'.$image.'" alt="img"></a>
        <div class="aa-cartbox-info">
        <h4><a href="#">' . $name . '</a></h4>
        <p>1 x $' . $price . '</p>
        </div>
        <a class="aa-remove-product" href="#?id='.$product_id.'"><span class="fa fa-times"></span></a>
      </li>
      ';

      $html_showcart .= '
      <tr>
         <td><a class="remove" href="cart.php?id=' . $product_id . '"><fa class="fa fa-close"></fa></a></td>
                   
         <td><a href="#"><img src="admin/resources/productimage/'.$image.'" alt="img"></a></td>

         <td><a class="aa-cart-title" href="#">' . $name . '</a></td>

         <td>' . '$' . $price . '</td>

         <td><input name="quantity" class="aa-cart-quantity" type="number" value="' . $quantity . '"></td>

         <td>' . $netprice . '</td>

         <td><input name-"product_id" type="hidden" class="aa-cart-quantity" type="number" value="' . $product_id . '"></td>
      </tr>
      ';
    } //row-while
  } else {
    //echo "0 results";
    $errors[] = array('inputs' => 'forms', 'msg' => 'invalid login');
  }
 // $conn->close();
} //size of err

function carttable()
{
  global $html_showcart;
  echo $html_showcart;
} //fn-carttable

function carticon_table()
{
  global $cart_icontable;
  echo $cart_icontable;
}

function cartcount()
{
  global $cnt;
  echo $cnt;
}

function total_amount()
{
  global $total;
  echo '$'.$total;
}
