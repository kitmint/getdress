<?php 
    session_start();
    require_once '../config/db.php';


    if(isset($_POST['updateBtn_admin'])){
        $user_id = $_POST['userid'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        // $email = $_POST['email'];

        $query = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname WHERE id = :id");
        $query->bindParam(':firstname', $firstname);
        $query->bindParam(':lastname', $lastname);
        // $query->bindParam(':email', $email);
        $query->bindParam(':id', $user_id);
        $query->execute();

        if($query){
            header("location: edit.php");
        }else{
            echo "Something went wrong please try again!";
        }
    }

    if(isset($_POST['homepage'])){
        header("location: user.php");
    }
?>
