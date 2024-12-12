<?php  

require_once 'dbConfig.php';


function checkIfUserExists($pdo, $username) {
	$response = array();
	$sql = "SELECT * FROM findhire_accounts WHERE username = ?";
	$stmt = $pdo->prepare($sql);

	if ($stmt->execute([$username])) {

		$userInfoArray = $stmt->fetch();

		if ($stmt->rowCount() > 0) {
			$response = array(
				"result"=> true,
				"status" => "200",
				"userInfoArray" => $userInfoArray
			);
		}

		else {
			$response = array(
				"result"=> false,
				"status" => "400",
				"message"=> "User doesn't exist from the database"
			);
		}
	}

	return $response;

}

function insertNewUser($pdo, $username, $first_name, $last_name, $password, $role) {
	$response = array();
	$checkIfUserExists = checkIfUserExists($pdo, $username);

	if (!$checkIfUserExists['result']) {
		$sql = "INSERT INTO findhire_accounts (username, first_name, last_name, password, role) 
		        VALUES (?,?,?,?,?)";
		$stmt = $pdo->prepare($sql);

		if ($stmt->execute([$username, $first_name, $last_name, $password, $role])) {
			$response = array(
				"status" => "200",
				"message" => "User successfully registered!"
			);
		} else {
			$response = array(
				"status" => "400",
				"message" => "An error occurred during registration."
			);
		}
	} else {
		$response = array(
			"status" => "400",
			"message" => "User already exists!"
		);
	}

	return $response;
}


function getAllUsers($pdo) {
	$sql = "SELECT * FROM findhire_accounts";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getUserByID($pdo, $user_id) {
	$sql = "SELECT * FROM findhire_accounts WHERE user_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$user_id]);

	if ($executeQuery) {
		return $stmt->fetch();		
	}
}

function getAllJobs($pdo) {
	$sql = "SELECT * FROM jobs 
			ORDER BY title ASC";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getJobByID($pdo, $job_id) {
    $sql = "SELECT * FROM jobs WHERE job_id = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$job_id])) {
        return $stmt->fetch();
    }
 }

function insertNewJob($pdo, $title, $city, $company, $category, $job_type, $experience_years, $job_description, $qualification, $added_by ) {

	$sql = "INSERT INTO jobs
			(
				title,
				city,
				company,
				category,
				job_type,
				experience_years,
				job_description,
				qualification,
				added_by

			)
			VALUES (?,?,?,?,?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$title, $city, $company, $category, $job_type, $experience_years, $job_description, $qualification, $added_by]);

	if ($executeQuery) {
		return true;
	}

}

function applyForJob($pdo, $user_id, $job_id, $app_resume, $letter) {
    $sql = "INSERT INTO job_applications (user_id, job_id, app_resume, letter) VALUES (?,?,?,?)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$user_id, $job_id, $app_resume, $letter])) {
        return "Application submitted successfully!";
    } else {
        return "An error occurred while applying for the job.";
    }
}

function getJobByUser($pdo, $user_id) {
    $sql = "SELECT 
                ja.job_app_id,
                ja.application_date,
                ja.user_id,
                ja.job_id,
                j.title AS job_title,
                j.city,
                j.company,
                j.category,
                j.job_type,
                j.experience_years,
                j.job_description,
                a.first_name AS applicant_first_name,
                a.last_name AS applicant_last_name,
                a.username AS applicant_username
            FROM 
                job_applications ja
            JOIN 
                jobs j ON ja.job_id = j.job_id
            JOIN 
                findhire_accounts a ON ja.user_id = a.user_id
            WHERE 
                ja.user_id = ?";  // Use user_id as a parameter
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    
    if ($stmt->rowCount() > 0) {
        return $stmt->fetchAll();
    } else {
        return []; // Return an empty array if no jobs are found for the user
    }
}

/*function getAllJobApplications()	{
		$sql = "SELECT 
		ja.job_app_id,
		ja.application_date,
		ja.user_id,
		ja.job_id,
		j.title AS job_title,
		ja.app_resume,
		ja.letter,
		a.first_name AS applicant_first_name,
		a.last_name AS applicant_last_name,
		a.username AS applicant_username
	FROM 
		job_applications ja
	JOIN 
		jobs j ON ja.job_id = j.job_id
	JOIN 
		findhire_accounts a ON ja.user_id = a.user_id
	WHERE 
		ja.user_id = ?";  // Use user_id as a parameter

	$stmt = $pdo->prepare($sql);
	$stmt->execute([$user_id]);

	if ($stmt->rowCount() > 0) {
	return $stmt->fetchAll();
	} else {
	return []; // Return an empty array if no jobs are found for the user
	}
}*/


/*function getAllMessage($pdo) {
	$sql = "SELECT * FROM messages 
			ORDER BY date_posted DESC";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}*/

function getAllMessage($pdo) {
    $sql = "SELECT 
                m.message_id, 
                m.content, 
                m.date_posted, 
                fa.first_name, 
                fa.last_name, 
                fa.username 
            FROM 
                messages m
            JOIN 
                findhire_accounts fa ON m.user_id = fa.user_id
            ORDER BY 
                m.date_posted DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




function sendMessage($pdo, $user_id, $recipient_id, $content) {
    $sql = "INSERT INTO messages (user_id, recipient_id, content) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$user_id, $recipient_id, $content]);
}

function getMessagesForHR($pdo, $hr_id) {
    $sql = "SELECT 
                m.message_id, 
                m.content, 
                m.date_posted, 
                fa.first_name, 
                fa.last_name, 
                fa.username 
            FROM 
                messages m
            JOIN 
                findhire_accounts fa ON m.user_id = fa.user_id
            WHERE 
                m.recipient_id = ?
            ORDER BY 
                m.date_posted DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$hr_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function deleteJob($pdo, $job_id) {

	$sql = "DELETE FROM jobs WHERE job_id = ?";
	$stmt = $pdo->prepare($sql);

	$executeQuery = $stmt->execute([$job_id]);

	if ($executeQuery) {
		return true;
	}

}

?>