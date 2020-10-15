<?php
include('config.php');
$errors = array();
$message = '';
if (isset($_POST['submit'])) {

    echo $name = isset($_POST['cat_name']) ? $_POST['cat_name'] : '';

    ///////////////////insert/////////////////////////////
    if (sizeof($errors) == 0) {
        $sql = "INSERT INTO categories (name)VALUES ('" . $name . "')";
        if ($conn->query($sql) === TRUE) {
            // $message = "New record created successfully";
        } else {
            $errors[] = array('inputs' => 'forms', 'msg' => $conn->error);
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
} //isset-submit
