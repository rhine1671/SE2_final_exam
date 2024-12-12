<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>

<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'HR') {
    header("Location: login.php");
    exit;
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Dashboard | FindHire</title>
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
        <h2 class="text-center">Welcome, HR!</h2>

        <?php if (isset($_SESSION['message'])) { ?>
            <h1 style="color: green; text-align: center; background-color: ghostwhite; border-style: solid;">	
                <?php echo $_SESSION['message']; ?>
            </h1>
        <?php } unset($_SESSION['message']); ?>
    

        <!-- Job Post Form -->
        <div class="mt-4">
            <h4 class="text-center mb-4">Post a New Job</h4>
            <form action="core/handleForms.php" method="POST" class="bg-white p-4 rounded shadow-sm">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="title" class="form-label">Job Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter job title">
                    </div>
                    <div class="col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" name="city" placeholder="Enter city">
                    </div>
                    <div class="col-md-6">
                        <label for="company" class="form-label">Company</label>
                        <input type="text" class="form-control" name="company" placeholder="Enter company name">
                    </div>
                    <div class="col-md-6">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" class="form-control" name="category" placeholder="Enter job category">
                    </div>
                    <div class="col-md-6">
                        <label for="job_type" class="form-label">Job Type</label>
                        <select class="form-select" id="job_type" name="job_type" required>
                            <option value="Full-Time">Full-Time</option>
                            <option value="Part-Time">Part-Time</option>
                            <option value="Freelance">Freelance</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="experience_years" class="form-label">Experience (Years)</label>
                        <input type="number" class="form-control" name="experience_years" placeholder="Years of experience">
                    </div>
                    <div class="col-12">
                        <label for="job_description" class="form-label">Job Description</label>
                        <textarea class="form-control" name="job_description" rows="3" placeholder="Provide a detailed job description"></textarea>
                    </div>
                    <div class="col-12">
                        <label for="qualification" class="form-label">Qualifications</label>
                        <textarea class="form-control" name="qualification" rows="3" placeholder="List required qualifications"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-success w-100 mt-4" name="insertNewJobBtn">Post Job</button>
            </form>
        </div>




        <!-- Job Post Card PHP -->
        <?php $getAllJobs = getAllJobs($pdo); ?>
        <?php foreach ($getAllJobs as $row) { ?>
        <div class="card mt-5">
            <div class="card-body">
                <h3 class="card-title"><?php echo $row['title']; ?></h3>
                <h5 class=""><?php echo $row['company']; ?></h5><br>
                <p class="card-text"> <?php echo $row['job_description']; ?></p>
                <p><strong>Location: </strong><?php echo $row['city']; ?></p>
                <p><strong>Experience: </strong><?php echo $row['experience_years'];?> years</p>
                <p><strong>Type: </strong><?php echo $row['job_type']; ?></p>
                <p><strong>Posted: </strong><?php echo $row['date_posted']; ?></p>
                <a href="viewJob.php?job_id=<?php echo $row['job_id'];?>" class="btn btn-primary">View Details</a>
                <a href="deleteJob.php?job_id=<?php echo $row['job_id'];?>" class="btn btn-danger" name="deleteJobBtn" >Delete</a>
            </div>
            <?php }?>
        </div>



    
    <!-- Messages Section -->

    <?php $getAllMessage = getAllMessage($pdo); ?>
    <?php foreach ($getAllMessage as $row) { ?>
    <div class="mt-5">
        <h4>Messages</h4>
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">From:  <?php echo $row['first_name']. ' '. $row['last_name']; ?></h5>
                <p class="card-text"> <?php echo $row['content']; ?></p>
                <button class="btn btn-primary">Reply</button>
            </div>
        </div><?php }?>
    </div>



    <!-- Footer -->
	<footer id="contact" class="bg-primary text-white text-center py-4">
        <p>Contact us at <a href="mailto:support@FindHire.com" class="text-light">support@FindHire.com</a></p>
        <p>© 2024 FindHire, All Rights Reserved</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
