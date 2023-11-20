<?php
session_start();
include_once "config.php";

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];

if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
    // Check if email is valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) { // If email already exists
            echo "$email - This email already exists!";
        } else {
            // If email doesn't exist
            if (isset($_FILES['image'])) { // If file is uploaded
                $img_name = $_FILES['image']['name']; // File name
                $tmp_name = $_FILES['image']['tmp_name']; // Temporary file name
                // File extension
                $img_explode = explode('.', $img_name); // Split file name
                $img_ext = end($img_explode); // Get last element (extension)
                $extensions = ['png', 'jpeg', 'jpg']; // Valid image extensions
                if (in_array($img_ext, $extensions)) { // Validate uploaded image
                    $new_img_name = uniqid('', true) . '.' . $img_ext; // New image name
                    $upload_path = "images/" . $new_img_name;
                    if (move_uploaded_file($tmp_name, $upload_path)) { // Upload image
                        $status = "Active now"; // User will be active after signup
                        $unique_id = bin2hex(random_bytes(16)); // Create random id
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password
                        // Insert user into database
                        $stmt = $conn->prepare("INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                                VALUES (?, ?, ?, ?, ?, ?, ?)");
                        $stmt->bind_param("sssssss", $unique_id, $fname, $lname, $email, $hashed_password, $new_img_name, $status);
                        if ($stmt->execute()) { // If data inserted
                            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
                            $stmt->bind_param("s", $email);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $_SESSION['unique_id'] = $row['unique_id']; // Using this session we used user unique_id in other php files
                                echo "success";
                            }
                        } else {
                            echo "Something went wrong";
                        }
                    } else {
                        echo "Failed to upload image";
                    }
                } else {
                    echo "Please select an image file - jpeg, jpg, png!";
                }
            } else {
                $status = "Active now"; // User will be active after signup
                $unique_id = bin2hex(random_bytes(16)); // Create random id
                $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password
                // Insert user into database
                $stmt = $conn->prepare("INSERT INTO users (unique_id, fname, lname, email, password, status)
                                            VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $unique_id, $fname, $lname, $email, $hashed_password, $status);
                if ($stmt->execute()) { // If data inserted
                    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $_SESSION['unique_id'] = $row['unique_id']; // Using this session we used user unique_id in other php files
                        echo "success";
                    }
                } else {
                    echo "Something went wrong";
                }
            }
        }
    } else {
        echo "$email - This is not a valid email!";
    }
} else {
    echo "Please fill all fields!";
}
?>

