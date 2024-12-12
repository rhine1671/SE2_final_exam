<?php  
require_once 'dbConfig.php';
require_once 'models.php';

if (isset($_POST['insertNewUserBtn'])) {
	$username = trim($_POST['username']);
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$password = trim($_POST['password']);
	$confirm_password = trim($_POST['confirm_password']);
	$role = trim($_POST['role']);

	if (!empty($username) && !empty($first_name) && !empty($last_name) && !empty($password) && !empty($confirm_password) && !empty($role)) {
		if ($password == $confirm_password) {
			$insertQuery = insertNewUser($pdo, $username, $first_name, $last_name, password_hash($password, PASSWORD_DEFAULT), $role);
			$_SESSION['message'] = $insertQuery['message'];

			if ($insertQuery['status'] == '200') {
				$_SESSION['message'] = $insertQuery['message'];
				$_SESSION['status'] = $insertQuery['status'];
				header("Location: ../login.php");
			} else {
				$_SESSION['message'] = $insertQuery['message'];
				$_SESSION['status'] = $insertQuery['status'];
				header("Location: ../register.php");
			}
		} else {
			$_SESSION['message'] = "Passwords do not match!";
			$_SESSION['status'] = '400';
			header("Location: ../register.php");
		}
	} else {
		$_SESSION['message'] = "All fields are required!";
		$_SESSION['status'] = '400';
		header("Location: ../register.php");
	}
}


if (isset($_POST['loginUserBtn'])) {
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	if (!empty($username) && !empty($password)) {
		$loginQuery = checkIfUserExists($pdo, $username);

		if ($loginQuery['result']) {
			$userIDFromDB = $loginQuery['userInfoArray']['user_id'];
			$usernameFromDB = $loginQuery['userInfoArray']['username'];
			$passwordFromDB = $loginQuery['userInfoArray']['password'];
			$roleFromDB = $loginQuery['userInfoArray']['role'];

			if (password_verify($password, $passwordFromDB)) {
				$_SESSION['user_id'] = $userIDFromDB;
				$_SESSION['username'] = $usernameFromDB;
				$_SESSION['role'] = $roleFromDB;

				if ($roleFromDB == 'HR') {
					header("Location: ../hrDashboard.php");
				} else {
					header("Location: ../appDashboard.php");
				}
			} else {
				$_SESSION['message'] = "Invalid username or password!";
				$_SESSION['status'] = "400";
				header("Location: ../login.php");
			}
		} else {
			$_SESSION['message'] = "User not found!";
			$_SESSION['status'] = "400";
			header("Location: ../login.php");
		}
	} else {
		$_SESSION['message'] = "Please fill all fields!";
		$_SESSION['status'] = '400';
		header("Location: ../login.php");
	}
}

if (isset($_GET['logoutUserBtn'])) {
	unset($_SESSION['username']);
	header("Location: ../index.php");
}


if(isset($_POST['insertNewJobBtn'])) {
    $title = trim($_POST['title']);
    $city = trim($_POST['city']);
    $company = trim($_POST['company']);
    $category = trim($_POST['category']);
    $job_type = trim($_POST['job_type']);
    $experience_years = trim($_POST['experience_years']);
    $job_description = trim($_POST['job_description']);
	$qualification = trim($_POST['qualification']);
    
    
	if (!empty($title) && !empty($city) && !empty($category) && !empty($company)
		&& !empty($job_type) && !empty($experience_years) && !empty($job_description) && !empty($qualification)) {
		$insertNewJob = insertNewJob($pdo,  $title, $city, $company, $category, $job_type, $experience_years, $job_description, $qualification, $_SESSION['username']);
		$_SESSION['status'] =  $insertNewPilot['status']; 
		$_SESSION['message'] =  "Job posted successfully";
		header("Location: ../hrDashBoard.php");
	}

	else {
		$_SESSION['message'] = "Please make sure there are no empty input fields";
		$_SESSION['status'] = '400';
		header("Location: ../index.php");
	}
}


if (isset($_POST['applyJobBtn'])) {
    $job_id = $_POST['job_id'];  // Assuming job_id is sent in the form
    $user_id = $_SESSION['user_id'];  // Assuming the user is logged in and their ID is stored in the session
    
    $app_resume = $_FILES['app_resume']['tmp_name'];  // Temporary file path
    $letter = trim($_POST['letter']);  // Cover letter text

    // Validate inputs
    if (empty($job_id) || empty($user_id) || empty($letter)) {
        $_SESSION['message'] = "Please make sure all required fields are filled.";
        $_SESSION['status'] = '400';
        header("Location: ../index.php");
        exit;
    }

    // Handle the resume file
    if (!empty($app_resume) && file_exists($app_resume)) {
        $resumeContent = file_get_contents($app_resume);  // Read file content for resume
    } else {
        $_SESSION['message'] = "Please upload a valid resume file.";
        $_SESSION['status'] = '400';
        header("Location: ../index.php");
        exit;
    }

    // Insert application data into the database
    $result = applyForJob($pdo, $user_id, $job_id, $resumeContent, $letter);

    if ($result) {
        $_SESSION['status'] = 'success';
        $_SESSION['message'] = 'Application submitted successfully!';
        header("Location: ../appDashBoard.php");
        exit;
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = 'Failed to submit application. Please try again.';
        header("Location: ../index.php");
        exit;
    }
}
if (isset($_POST['deleteJobBtn'])) {
	$query = deleteJob($pdo, $_GET['job_id']);

	if ($query) {
		$_SESSION['status'] = 'success';
        $_SESSION['message'] = 'Job deleted successfully!';
		header("Location: ../hrDashBoard.php");
	}
	else {
		echo "Deletion failed";
	}
}

if (isset($_POST['sendMsgBtn'])) {
    $content = trim($_POST['content']);
    $user_id = $_SESSION['user_id']; // Logged-in user's ID
    $recipient_id = 1; // Assuming `1` is the HR's user_id; this could be dynamic.

    if (!empty($content)) {
        $messageSent = sendMessage($pdo, $user_id, $recipient_id, $content);

        if ($messageSent) {
            $_SESSION['message'] = "Message sent successfully!";
            $_SESSION['status'] = 'success';
            header("Location: ../appDashBoard.php");
        } else {
            $_SESSION['message'] = "Failed to send message. Please try again.";
            $_SESSION['status'] = 'error';
            header("Location: ../index.php");
        }
    } else {
        $_SESSION['message'] = "Message content cannot be empty.";
        $_SESSION['status'] = 'error';
        header("Location: ../index.php");
    }
}





?>