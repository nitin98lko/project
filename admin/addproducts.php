<?php
include('config.php');

$errors = array();
$message = '';
if (isset($_POST['submit'])) {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    //$image = isset($_POST['image']) ? $_POST['image'] : '';
    $short_desc = isset($_POST['short_desc']) ? $_POST['short_desc'] : '';
    $long_desc = isset($_POST['long_desc']) ? $_POST['long_desc'] : '';

    ///////////////images
    $file_name = $_FILES['file']['name'];
    $file_tem_loc = $_FILES['file']['tmp_name'];
    $file_store = "resources/images/" . $file_name;
    if (move_uploaded_file($file_tem_loc, $file_store)) {
        echo "upload=" . $file_name;
    } else {
        echo "error";
    }
    ////////////////images


    $dropdown = $_POST['dropdown'];

    $gettags = $_POST['tags'];
    $intags='';
    foreach ($gettags as $keys => $values) {
         $intags .= $values.' ';
    }

    ///////////////////insert/////////////////////////////
    if (sizeof($errors) == 0) {
        $sql = "INSERT INTO products (category_id,name, price, image, short_desc, long_desc)VALUES ('" . $dropdown . "','" . $name . "', '" . $price . "', '" . $file_name . "', '" . $short_desc . "', '" . $long_desc . "')";
        if ($conn->query($sql) === TRUE) {
            // $message = "New record created successfully";
        } else {
            $errors[] = array('inputs' => 'forms', 'msg' => $conn->error);
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    // if (sizeof($errors) == 0) {
    //     $sql = "INSERT INTO products (name, price, image, short_desc, long_desc)VALUES ('" . $name . "', '" . $price . "', '" . $file_name . "', '" . $short_desc . "', '" . $long_desc . "')";
    //     if ($conn->query($sql) === TRUE) {
    //         // $message = "New record created successfully";
    //     } else {
    //         $errors[] = array('inputs' => 'forms', 'msg' => $conn->error);
    //         echo "Error: " . $sql . "<br>" . $conn->error;
    //     }
    // }
    ///////////////////insert/////////////////////////////

    echo '<br>' . $name;
    echo '<br>' . $price;
    echo '<br>' . $file_name;
    echo '<br>' . $dropdown;
    echo '<br>' . $intags;
    echo '<br>' . $short_desc;
    echo '<br>' . $long_desc;

    $conn->close();
} //isset-submit


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="style.css">
    <title>Index</title>
</head>

<body>

    <div id="message">
        <?php echo $message; ?>
    </div>

    <div id="errors">
        <?php if (sizeof($errors) > 0) :  ?>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error['msg'];  ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <form action="?" method="POST" enctype="multipart/form-data">

        <div class="inputs">
            <p>
                <label for="name">Name: </label>
            </p>
            <p>
                <input type="text" name="name" required>
            </p>
        </div>

        <div class="inputs">
            <p>
                <label for="price">Price: </label>

            </p>
            <p>
                <input type="text" name="price" required>
            </p>
        </div>

        <div class="inputs">
            <p>
                <label>Uploading Files</label>
            </p>
            <p>
                <input type="file" name="file">
            </p>
        </div>


        <p>
            <label>Category</label>
            <select name="dropdown" class="small-input">
                <option value="1">Men</option>
                <option value="2">Women</option>
                <option value="3">Kids</option>
                <option value="4">Electronics</option>
                <option value="5">Sports</option>
            </select>
        </p>

        <p>
            <label>Tags</label>
            <input type="checkbox" name="tags[]" value="fashion" /> Fashion
            <input type="checkbox" name="tags[]" value="ecommerce" /> Ecommerce
            <input type="checkbox" name="tags[]" value="shop" /> Shop
            <input type="checkbox" name="tags[]" value="handbag" /> Hand Bag
            <input type="checkbox" name="tags[]" value="laptop" /> Laptop
            <input type="checkbox" name="tags[]" value="headphone" /> Headphone
        </p>


        <div class="inputs">
            <p>
                <label for="short_desc">Short Description: </label>

            </p>
            <p>
                <input type="text" name="short_desc" required>
            </p>
        </div>


        <p>
            <label for="long_desc">long Description: </label>
            <textarea class="text-input textarea wysiwyg" id="textarea" name="long_desc" cols="79" rows="15"></textarea>
        </p>
        <!-- 
        <div class="inputs">
            <p>
                <label for="long_desc">long Description: </label>
            </p>
            <p>
                <input type="text" name="long_desc" required>
            </p>
        </div> -->

        <p>

        </p>

        <p>
            <input type="submit" name="submit" value="Submit">
        </p>

    </form>
</body>

</html>