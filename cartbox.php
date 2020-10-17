<?php

$cart_icontable='';

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

      $cart_icontable .='

<li>
<a class="aa-cartbox-img" href="#"><img src="img/woman-small-2.jpg" alt="img"></a>
<div class="aa-cartbox-info">
  <h4><a href="#">'.$name.'</a></h4>
  <p>1 x $'.$price.'</p>
</div>
<a class="aa-remove-product" href="#"><span class="fa fa-times"></span></a>
</li>
';
    } //row-while
  } //rslt
} //err
function carticon_table(){
global $cart_icontable;
echo $cart_icontable;


}
