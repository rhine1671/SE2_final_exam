<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | FindHire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">FindHire</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>



    <div class="container mt-5">
        <h2 class="text-center">Register for FindHire</h2>
        <?php  
        if (isset($_SESSION['message']) && isset($_SESSION['status'])) {

            if ($_SESSION['status'] == "200") {
                echo "<h1 style='color: green;'>{$_SESSION['message']}</h1>";
            }

            else {
                echo "<h1 style='color: red;'>{$_SESSION['message']}</h1>";	
            }

        }
        unset($_SESSION['message']);
        unset($_SESSION['status']);
        ?>

        <form class="mt-4" action="core/handleForms.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="username" class="form-control" name="username" placeholder="Enter your username">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">First Name</label>
                <input type="text" class="form-control" name="first_name" placeholder="Enter your first name">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="last_name" placeholder="Enter your last name">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Create a password">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm a password">
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">I am an:</label>
                <select class="form-select" name="role">
                    <option value="HR">HR</option>
                    <option value="Applicant">Applicant</option>
                </select>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary" name="insertNewUserBtn">Register</button>
            </div>
            <div class="text-center mt-3">
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </form>
    </div>
    <!-- Footer -->
    <footer id="contact" class="bg-primary text-white text-center py-4">
        <p>Contact us at <a href="mailto:support@FindHire.com" class="text-light">support@FindHire.com</a></p>
        <p>© 2024 FindHire, All Rights Reserved</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
