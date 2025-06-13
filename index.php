<?php  
require_once('contact.php'); // Ensure database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="new.css">
</head>
<body> 

    <div class="container">

    <!-- PHP Message Display -->
    <div class="one">
        <?php 
            if (isset($_GET['message'])) {
                echo htmlspecialchars($_GET['message']);
            }
        ?>
    </div>
       
    <!-- Signup Form -->
    <h2>Sign<span>up</span></h2>
    <form id="signupForm">
        <input type="text" name="name" placeholder="Full Name" id="name" required><br>
        <input type="email" name="email" placeholder="Email Address" id="email" required><br>
        <input type="password" name="password" placeholder="Password" id="password" required><br>
        <input type="password" name="confirmpassword" placeholder="Confirm Password" id="confirmpassword" required><br>
        <button type="submit" id="register">Signup</button>
    </form>
   </div> 

   <!-- Include jQuery and SweetAlert -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <script type="text/javascript">
$(document).ready(function() {
    $('#register').click(function(e) {
        e.preventDefault();
        
        var valid = document.getElementById("signupForm").checkValidity();
        if(valid) {
            var name = $('#name').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var confirmpassword = $('#confirmpassword').val();

            if (password !== confirmpassword) {
                Swal.fire({
                    title: "Error",
                    text: "Passwords do not match!",
                    icon: "error"
                });
                return;
            }

            $.ajax({
                type: 'POST',
                url: 'process.php',
                data: {name: name, email: email, password: password, confirmpassword: confirmpassword},
                success: function(data) {
                    Swal.fire({
                        title: "Successful",
                        text: data,
                        icon: "success"
                    });
                },
                error: function() {
                    Swal.fire({
                        title: "Failed",
                        text: "Failed to save data.",
                        icon: "error"
                    });
                }
            });
        }
    });
});
</script>

</body>
</html>

