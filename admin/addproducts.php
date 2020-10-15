<?php
include('config.php');

$errors = array();
$message = '';
if (isset($_POST['submit'])) {

    ///////////////images
    $file_name = $_FILES['file']['name'];
    $file_tem_loc = $_FILES['file']['tmp_name'];
    $file_store = "resources/productimage/" . $file_name;
    if (move_uploaded_file($file_tem_loc, $file_store)) {
        echo "upload=" . $file_name;
    } else {
        echo "error" . $file_name;
    }
    ////////////////images	

    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    //$image = isset($_POST['image']) ? $_POST['image'] : '';
    $short_desc = isset($_POST['short_desc']) ? $_POST['short_desc'] : '';
    $long_desc = isset($_POST['long_desc']) ? $_POST['long_desc'] : '';

    $dropdown = $_POST['dropdown'];

    $gettags = $_POST['tags'];
    $intags = '';
    foreach ($gettags as $keys => $values) {
        $intags .= $values . ' ';
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

    $conn->close();
} //isset-submit
