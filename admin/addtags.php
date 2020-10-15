<?php
include('config.php');
$errors = array();
$message = '';
if (isset($_POST['submit'])) {

    echo "tags page=" . $name = isset($_POST['tag_name']) ? $_POST['tag_name'] : '';

    ///////////////////insert/////////////////////////////
    if (sizeof($errors) == 0) {
        $sql = "INSERT INTO tags (name)VALUES ('" . $name . "')";
        if ($conn->query($sql) === TRUE) {
            // $message = "New record created successfully";
        } else {
            $errors[] = array('inputs' => 'forms', 'msg' => $conn->error);
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
} //isset-submit
