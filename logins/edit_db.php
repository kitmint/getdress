<?php 
session_start();
require_once '../config/db.php';

if (isset($_POST['updateBtn'])) {
    $user_id = $_POST['userid'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phonenumber = $_POST['phonenumber'];

    $query = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, phonenumber = :phonenumber WHERE id = :id");
    $query->bindParam(':firstname', $firstname);
    $query->bindParam(':lastname', $lastname);
    $query->bindParam(':id', $user_id);
    $query->bindParam(':phonenumber', $phonenumber);
    $query->execute();

    

    if ($query) {
        $_SESSION['update_message'] = 'Update successful!';
    } else {
        $_SESSION['update_message'] = 'Update failed. Please try again!';
    }

    header("location: edit.php");
    exit();
}

if (isset($_POST['myprofile'])) {
    header("location: userprofile.php");
    exit();
}
?>
