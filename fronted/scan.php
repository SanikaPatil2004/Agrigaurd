<?php
session_start();

// Simulating a logged-in farmer (Replace with real authentication session)
if (!isset($_SESSION['username'])) {
    header("Location: home.php");
    exit; 
}

$farmerName = $_SESSION['username'];
$message = "";

// Handle Image Upload
if (isset($_POST['upload'])) {
    if (isset($_FILES['crop_image']) && $_FILES['crop_image']['error'] == 0) {
        $uploadDir = 'uploads/';
        $fileName = basename($_FILES['crop_image']['name']);
        $targetFile = $uploadDir . $fileName;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Allow only image files
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['crop_image']['tmp_name'], $targetFile)) {
                $message = "Image uploaded successfully!";
            } else {
                $message = "Error uploading image.";
            }
        } else {
            $message = "Invalid file type. Only JPG, PNG, and GIF allowed.";
        }
    } else {
        $message = "Please select an image to upload.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crop Image Upload</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
<header>
        <nav class="navbar">
            <a href="home.php"><img src="images/logo.jpg" alt="users Logo" style="height: 50px;"/></a>
            <ul class="nav-items">
                <li><a href="home.php">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Features</a></li>
            </ul>
            <button id="logoutBtn"><a href="logout.php">Logout</a></button>
        </nav>
    </header>

<div class="container">
    <h2 style="margin-bottom:20px;">Welcome, <?php echo htmlspecialchars($farmerName); ?>!</h2>
    <p style="margin-bottom:20px;">Upload an image of your crop for analysis.</p>
    
    <?php if ($message): ?>
        <p class="message"> <?php echo $message; ?> </p>
    <?php endif; ?>

    <form action="process.php" method="POST" enctype="multipart/form-data">
        <label for="crop_image" class="upload-label">Choose an Image:</label>
        <input type="file" name="crop_image" id="crop_image" accept="image/*" required>
        <button type="submit" name="upload" class="button">Upload Image</button>
    </form>
</div>
<footer style="margin-top:300px;">
    <p>&copy; 2024 AI Driven Crop Disease Prediction System. All rights reserved.</p>
</footer>
</body>
</html>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }
    body {
        background-color: #f0f8ff;
        text-align: center;
    }
    /* .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #2c3e50;
        padding: 15px 50px;
    }
    .logo img {
        height: 50px;
    }
    .nav-items {
        list-style: none;
        display: flex;
    }
    .nav-items li {
        margin: 0 15px;
    }
    .nav-items a {
        text-decoration: none;
        color: white;
        font-size: 16px;
        transition: 0.3s;
    }
    .nav-items a:hover {
        color: #1abc9c;
    }*/
    #logoutBtn {
        background-color: #e74c3c;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
    } 
    .container {
        margin: 50px auto;
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 40%;
        color:black;
    }
    .message {
        color: green;
        font-weight: bold;
        margin-top: 10px;
    }
    .upload-label {
        display: block;
        font-size: 16px;
        margin-bottom: 10px;
        font-weight: bold;
    }
    input[type="file"] {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 100%;
        margin-bottom: 15px;
    }
    .button {
        background-color: #27ae60;
        color: white;
        padding: 12px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        width: 100%;
        font-size: 16px;
    }
    .button:hover {
        background-color: #219150;
    }
</style>
