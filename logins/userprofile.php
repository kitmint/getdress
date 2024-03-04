<?php
session_start();
require_once '../config/db.php';

if (isset($_SESSION['user_login'])) {
    $user_id = $_SESSION['user_login'];
    $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Handle file upload อัปโหลดรูป
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_picture"])) {
    $target_dir = "../picture/";
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["profile_picture"]["size"] > 500000) {
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $uploadOk = 0;
    }

    // If all checks pass, move the uploaded file to the target directory
    if ($uploadOk) {
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);

        // Update the user's filename in the database
        $filename = basename($_FILES["profile_picture"]["name"]);
        $updateStmt = $conn->prepare("UPDATE users SET filename = :filename WHERE id = :id");
        $updateStmt->bindParam(':filename', $filename);
        $updateStmt->bindParam(':id', $user_id);
        $updateStmt->execute();

        // Refresh the page to display the updated image
        header("Location: userprofile.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
    <div class="profile-container">
        <div class="profile-header">
            <h1>User Profile</h1>
        </div>
        
        <div class="profile-content">
            <div class="profile-picture">
                <!-- แสดงรูป -->
                <img src="../picture/<?php echo $row['filename']; ?>" style="width: 150px; height: 150px; border-radius: 50%;">
                <!-- ฟอร์มอัปโหลดรูป -->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                    <label for="profile_picture">Upload new profile picture:</label>
                    <input type="file" name="profile_picture" id="profile_picture" accept="image/*">
                    <button type="submit">Upload</button>
                </form>
            </div>
            <div class="user-info">
                <!-- แสดงข้อมูล -->
                <p><strong>Username:</strong> <?php echo $row['firstname'] . " " . $row['lastname']; ?></p>
                <p><strong>Email:</strong> <?php echo $row['email']; ?> </p>
                <p><strong>Phone number:</strong> <?php echo $row['phonenumber']; ?> </p>
            </div>
        </div>
        <!-- edit profile -->
        <a href="edit.php" class="btn btn-danger">Edit profile</a>
        
        <!-- logout -->
        <a href="user.php" class="btn btn-danger">Home page</a>
    </div>

</body>
</html>
