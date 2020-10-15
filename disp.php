<?php
include('admin/config.php');

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $image = $row["image"];
        $name = $row["name"];
        $price = $row["price"];

        $checkbox .= '<input type="checkbox" name="tags[]" value=' . $tid . '>' . $tname;
    }
}
$checkbox .= "</select>";
echo $checkbox;
?>





<li>
    <figure>
        <a class="aa-product-img" href="#"><img src="img/women/girl-1.png" alt="polo shirt img"></a>
        <a class="aa-add-card-btn" href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
        <figcaption>
            <h4 class="aa-product-title"><a href="#">This is Title</a></h4>
            <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
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