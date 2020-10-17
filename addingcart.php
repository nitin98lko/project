<?php
include('admin/config.php');
session_start();

$errors = array();


$html_showquickview;

if (isset($_POST['add_to_cart'])) {

  $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
  $name = isset($_POST['name']) ? $_POST['name'] : '';
  $image = isset($_POST['image']) ? $_POST['image'] : '';
  $quantity = 1;
  $price = isset($_POST['price']) ? $_POST['price'] : '';
  $netprice = $price * $quantity;

  if (sizeof($errors) == 0) {

    $sql = "INSERT INTO cart (id,name,image,quantity,price,netprice)VALUES ('" . $product_id . "','" . $name . "', '" . $image . "', '" . $quantity . "', '" . $price . "','" . $netprice . "')";
    //$sql = "INSERT INTO users (username, password, email)VALUES ('" . $username . "', '" . $password . "', '" . $email . "')";


    if ($conn->query($sql) === TRUE) {
      // $message = "New record created successfully";
    } else {
      $errors[] = array('inputs' => 'forms', 'msg' => $conn->error);
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
} /////if-quickview



$del_id = $_GET['id'];
if($del_id!="")
{
  $sql = "DELETE FROM cart WHERE id=$del_id";

  if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
    $del_id="";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}



////////////////////////////////////displaying products in the cart.php //////////////////////////////
$cnt=0;
$sql = "SELECT * FROM cart";
$result = $conn->query($sql);
$errors = array();
$html_showcart = '';

if (sizeof($errors) == 0) {

  if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
      $cnt=$cnt+1;
      $name = $row["name"];
      $price = $row["price"];
      $quantity = $row["quantity"];
      $product_id = $row["id"];
      $image = $row["image"];
      $netprice = $row["netprice"];

      $html_showcart .= '
      <tr>

      <td><a class="remove" href="cart.php?id=' . $product_id . '"><fa class="fa fa-close"></fa></a></td>
                   
      <td><a href="#"><img src="img/man/polo-shirt-1.png" alt="img"></a></td>

      <td><a class="aa-cart-title" href="#">' . $name . '</a></td>

      <td>' . '$' . $price . '</td>

      <td><input name="quantity" class="aa-cart-quantity" type="number" value="' . $quantity . '"></td>

      <td>' . $netprice . '</td>

      <td><input name-"product_id" type="hidden" class="aa-cart-quantity" type="number" value="' . $product_id . '"></td>

      </tr>
  ';
    } //row-while
  } //rslt
} //err

function cartcount(){
  global $cnt;
 
  echo $cnt;
}

function carttable()
{
  global $html_showcart;
  echo $html_showcart;
} //fn-carttable

function datashow()
{
  echo '<pre>';
  print_r(($_SESSION['cart']));
  //print_r($_POST);
  // print_r($cart);
  echo '<pre>';
}
