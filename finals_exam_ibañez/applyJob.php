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
    <title>Apply Now | FindHire</title>
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

    <!-- Apply Now Section -->
    <section class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4" id="apply">Apply Now</h2>
            <form class="row g-3" action="core/handleForms.php" method="POST" enctype="multipart/form-data">
           <input type="hidden" name="job_id" value="<?php echo $_GET['job_id']; ?>"><!--Pass the job ID -->
                <div class="col-md-12">
                    <label for="resume" class="form-label">Upload Resume</label>
                    <input type="file" class="form-control" name="app_resume">
                </div>
                <div class="col-md-12">
                    <label for="coverLetter" class="form-label">Cover Letter</label>
                    <textarea class="form-control" name="letter" rows="4" placeholder="Write your cover letter"></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary w-100" name="applyJobBtn">Submit Application</button>
                </div>
            </form>
        </div>
    </section>

        <!-- Messages Section -->
        <div class="mt-5 my-5 mx-5">
            <h4>Message HR</h4>
            <form action="core/handleForms.php" method="POST">
                <div class="mb-3">
                    <label for="hr-message" class="form-label">Your Message</label>
                    <textarea class="form-control" id="hr-message" rows="4" name="content" placeholder="Enter your message"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="sendMsgBtn">Send Message</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
	<footer id="contact" class="bg-primary text-white text-center py-4">
        <p>Contact us at <a href="mailto:support@FindHire.com" class="text-light">support@FindHire.com</a></p>
        <p>© 2024 FindHire, All Rights Reserved</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
