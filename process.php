<?php  
require_once('contact.php'); // Ensure database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword']; // Corrected case

    // Check if passwords match
    if ($password !== $confirmpassword) {
        echo "Passwords do not match!";
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare and execute database query
    $sql = "INSERT INTO logg (name, email, password) VALUES (?, ?, ?)";
    $stmtinsert = $db->prepare($sql);
    $result = $stmtinsert->execute([$name, $email, $hashedPassword]);

    if ($result) {
        echo "Successfully saved.";
    } else {
        echo "Error while saving data: " . implode(" | ", $stmtinsert->errorInfo());
    }
} else {
    echo "Invalid request.";
}
?>

