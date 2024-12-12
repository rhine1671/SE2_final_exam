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
    <title>Applicant Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/styles1.css">
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
                    <li class="nav-item"><a class="nav-link" href="core/handleForms.php?logoutUserBtn=1">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center">Welcome, <?php echo $_SESSION['username']; ?></h2>

        <?php if (isset($_SESSION['message'])) { ?>
            <h1 style="color: green; text-align: center; background-color: ghostwhite; border-style: solid;">	
                <?php echo $_SESSION['message']; ?>
            </h1>
        <?php } unset($_SESSION['message']); ?>


        <!-- Job Post Card PHP -->
        <?php $getAllJobs = getAllJobs($pdo); ?>
        <?php foreach ($getAllJobs as $row) { ?>
        <div class="card mt-4">
            <div class="card-body">
                <h3 class="card-title"><?php echo $row['title']; ?></h3>
                <h5 class=""><?php echo $row['company']; ?></h5><br>
                <p class="card-text"> <?php echo $row['job_description']; ?></p>
                <p><strong>Location: </strong><?php echo $row['city']; ?></p>
                <p><strong>Experience: </strong><?php echo $row['experience_years'];?> years</p>
                <p><strong>Type: </strong><?php echo $row['job_type']; ?></p>
                <p><strong>Posted: </strong><?php echo $row['date_posted']; ?></p>
                <a href="viewJob.php?job_id=<?php echo $row['job_id']; ?>" class="btn btn-primary">View Details</a>
                <button class="btn btn-success ms-2">Apply</button>
            </div>
            <?php }?>
        </div>


        <!-- Messages Section -->
        <div class="my-5 mx-5">
            <h4>Message HR</h4>
            <form action="core/handleForms.php" method="POST">
                <div class="mb-3">
                    <label for="content" class="form-label">Your Message</label>
                    <textarea class="form-control" id="hr-message" name="content" rows="4" placeholder="Enter your message"></textarea>
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
