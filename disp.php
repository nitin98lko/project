<?php
include('admin/config.php');

//////////////////////////////////DISPLAY CATEGORY////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
$show_cat = '';

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {

    $cid = $row["category_id"];
    $cname = $row["name"];

    $show_cat .= '<form id="form1" action="" method="POST"> 

                  <input type="submit" name="filter_cat" value="' . $cname . '" > <br>
                  <input type="hidden" name="set_cat" value="' . $cname . '" >

                  </form>';
  }
}

//////////////////////////////////SET UP CATEGORY FILTER////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


if (isset($_POST['filter_cat'])) {

  echo $_POST['set_cat'];
}

//////////////////////////////////DISPLAY TAGS////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$sql = "SELECT * FROM tags";
$result = $conn->query($sql);
$show_tags = '';

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {

    $cid = $row["tags_id"];
    $tname = $row["name"];

    $show_tags .= '<form id="form1" action="" method="POST"> 

                  <input type="submit" name="filter_tag" value="' . $tname . '" >
                  <input type="hidden" name="set_tag" value="' . $tname . '" >

                  </form>';
  }
}
//////////////////////////////////SET UP TAGS FILTER////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


if (isset($_POST['filter_tag'])) {


  echo $_POST['set_tag'];
}

//////////////////////////////////ONLOAD DEFAULT SHOW ALL PRODUCTS////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$sql = "SELECT * FROM products";
$result = $conn->query($sql);

$html_showprod = '';

$errors = array();

if (sizeof($errors) == 0) {

  if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

      $name = $row["name"];
      $price = $row["price"];
      $image = $row["image"];
      $product_id = $row["product_id"];



      //$img = '<img name="image" src="admin/resources/productimage/' . $image . ' "> '; //getting image from array

      $html_showprod .= '
        <li>
                  <figure>
                    <a class="aa-product-img" href="product-detail.php?id=' . $product_id . '"><img src="img/women/girl-1.png" alt="polo shirt img"></a>

                    <form id="form1" action="" method="POST"> 
                    
                    <input name="name" type="text" name="set_tag" value="' . $name . '" >
                    <input name="price" type="text" name="set_tag" value="' . $price . '" >
                    <input name="image" type="text" name="set_tag" value="' . $image . '" >
                    <input name="product_id" type="text" name="set_tag" value="' . $product_id . '" >

                    <button name="add_to_cart" class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</button>

                    </form>
                    <figcaption>
                      <h4 class="aa-product-title"><a href="#">' . $name . '</a></h4>
                      <span class="aa-product-price">' . $price . '</span><span class="aa-product-price"><del>$65.50</del></span>
                      <p class="aa-product-descrip">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam accusamus facere iusto, autem soluta amet sapiente ratione inventore nesciunt a, maxime quasi consectetur, rerum illum.</p>
                    </figcaption>
                  </figure>                         
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                            
                  </div>   
                  <!-- product badge -->
                  <span class="aa-badge aa-sale" href="#">SALE!</span>
         </li>
        ';
    }
  } //if
} else {
  //echo "0 results";
  $errors[] = array('inputs' => 'forms', 'msg' => 'invalid login');
}


//////////////////////////////////SET UP PRICE FILTER////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


if (isset($_POST['filter_price'])) {

  echo '<br>' . $lower = $_POST['lwr_price'];
  echo '<br>' . $upper = $_POST['upr_price'];

  $sql = "SELECT * FROM products WHERE price BETWEEN '" . $lower . "' AND '" . $upper . "'";
  $result = $conn->query($sql);

  $html_showprod = '';

  $errors = array();

  if (sizeof($errors) == 0) {

    if ($result->num_rows > 0) {

      while ($row = $result->fetch_assoc()) {
        $name = $row["name"];
        $price = '$' . $row["price"];
        $image = $row["image"];

        //$img = '<img name="image" src="admin/resources/productimage/' . $image . ' "> '; //getting image from array

        $html_showprod .= '
           <li>
                     <figure>
                       <a class="aa-product-img" href="#"><img src="img/women/girl-1.png" alt="polo shirt img"></a>
                       <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                       <figcaption>
                         <h4 class="aa-product-title"><a href="#">' . $name . '</a></h4>
                         <span class="aa-product-price">' . $price . '</span><span class="aa-product-price"><del>$65.50</del></span>
                         <p class="aa-product-descrip">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam accusamus facere iusto, autem soluta amet sapiente ratione inventore nesciunt a, maxime quasi consectetur, rerum illum.</p>
                       </figcaption>
                     </figure>                         
                     <div class="aa-product-hvr-content">
                       <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                       <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                       <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                            
                     </div>   
                     <!-- product badge -->
                     <span class="aa-badge aa-sale" href="#">SALE!</span>
            </li>
           ';
      }
    } //if


  } else {
    //echo "0 results";
    $errors[] = array('inputs' => 'forms', 'msg' => 'invalid login');
  }

  echo "SETTING PRICE";
} //if  isset-btn_set_price







//////////////////////////////////DISPLAY PRODUCTS WITH ANY FILTER////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function show()
{
  global $html_showprod;
  echo $html_showprod;
}
$conn->close();
