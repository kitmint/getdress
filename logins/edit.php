<?php
session_start();

// Check if there's an update message
if (isset($_SESSION['update_message'])) {
    $updateMessage = $_SESSION['update_message'];

    // Display a notification based on the update message
    echo '<div class="alert alert-' . (strpos($updateMessage, 'successful') !== false ? 'success' : 'danger') . '" role="alert">' . $updateMessage . '</div>';

    // Clear the update message session variable
    unset($_SESSION['update_message']);
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Getdress</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <h3 class="mt-4">แก้ไขข้อมูลส่วนตัว</h3>
        <hr>
        <form action="edit_db.php" method="POST">
        
        
            

        <?php
            
            require_once '../config/db.php';

                                    
            // Data user
            if (isset($_SESSION['user_login'])) {
                $user_id = $_SESSION['user_login'];
                $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            }

        ?>
        

        <input type="hidden" name="userid" value="<?php echo $row['id']; ?>">
        <input type="text" name="firstname" value="<?php echo $row['firstname']; ?>" placeholder="Enter your firstname...">
        <br>
        <input type="text" name="lastname" value="<?php echo $row['lastname']; ?>" placeholder="Enter your lastname...">
        <br>
        <input type="text" name="email" value="<?php echo $row['email']; ?>" placeholder="Enter your email..." readonly>
        <br>
        <input type="text" name="phonenumber" value="<?php echo $row['phonenumber']; ?>" placeholder="Enter your phonenumber..." >
        <br>
        <button type="submit" name="updateBtn">Update Data</button> 
        
        <button type="submit" name="myprofile">My Profile</button>
          
        
        </form>
    </div>
    
</body>
</html>
