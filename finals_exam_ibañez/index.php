<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindHire Job Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">FindHire</a>
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

    <!-- Hero Section -->
    <header class="hero-section text-center text-white" style="background: url('01.jpg') no-repeat center center / cover; height: 80vh;">
        <div class="container">
            <h1>Find Your Dream Job</h1>
            <p class="lead">Connecting you to top companies around the globe</p>
            <form class="d-flex justify-content-center mt-4">
                <input class="form-control me-2" type="search" placeholder="Job title or keyword" aria-label="Search">
                <button class="btn btn-success" type="submit">Search</button>
            </form>
        </div>
    </header>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Why Choose Us?</h2>
            <div class="row text-center">
                <div class="col-md-4">
                    <i class="bi bi-briefcase-fill feature-icon"></i>
                    <h5>Wide Job Selection</h5>
                    <p>Browse thousands of job openings tailored to your skills.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-people-fill feature-icon"></i>
                    <h5>Top Employers</h5>
                    <p>Get connected to leading companies in the industry.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-graph-up-arrow feature-icon"></i>
                    <h5>Career Growth</h5>
                    <p>Find jobs that accelerate your professional development.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer id="contact" class="bg-primary text-white text-center py-4">
        <p>Contact us at <a href="mailto:support@FindHire.com" class="text-light">support@FindHire.com</a></p>
        <p>© 2024 FindHire, All Rights Reserved</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
