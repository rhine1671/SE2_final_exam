<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>

<?php

if ($_SESSION['role'] !== 'Applicant') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">JobFinder</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#jobs">Jobs</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Job Details Section -->
    <?php $getJobByID = getJobByID($pdo, $_GET['job_id']); ?>
    
    <header class="bg-light py-5">
        <div class="container text-center">
            <h1><?php echo $getJobByID['title']; ?></h1>
            <p class="lead">Location: <?php echo $getJobByID['city']; ?> | <?php echo $getJobByID['job_type']; ?> </p>
            <a class="btn btn-primary mt-3" href="applyJob.php?job_id=<?php echo $_GET['job_id']; ?>">Apply Now</a>
        </div>
    </header>


    <section class="py-5">
        <div class="container">
            <h2 class="mb-4">Job Description</h2>
            <p><?php echo $getJobByID['job_description']; ?></p>

            <h3 class="mt-4">Company</h3>
            <p><?php echo $getJobByID['company']; ?></p>

            <h3 class="mt-4">Experience</h3>
            <p> Minimum of <?php echo $getJobByID['experience_years']; ?> years</p>


            <h3 class="mt-4">Qualifications</h3>
            <p><?php echo $getJobByID['qualification']; ?></p></p>

        </div>
    </section> 



    <!-- Footer -->
    <footer class="bg-primary text-white text-center py-3">
        <p>Contact us at <a href="mailto:info@jobfinder.com" class="text-light">info@jobfinder.com</a></p>
        <p>© 2024 JobFinder, All Rights Reserved</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
