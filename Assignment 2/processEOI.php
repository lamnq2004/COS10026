<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="description" content="Process EOI Records" />
	<title>EOI Confirmation</title>
</head>

<body>
	<h1>EOI Confirmation</h1>
	<?php
	require_once("./utility.php");
	require_once("./validation.php");

	try {
		$job_reference_number = sanitise_input($_POST["job_reference_number"]);
		$first_name = sanitise_input($_POST["first_name"]);
		$last_name = sanitise_input($_POST["last_name"]);
		$email = sanitise_input($_POST["email"]);
		$phone_number = sanitise_input($_POST["phone_number"]);
		$date_of_birth = sanitise_input($_POST["date_of_birth"]);
		$gender = $_POST["gender"];
		$street_address = sanitise_input($_POST["street_address"]);
		$suburb_town = sanitise_input($_POST["suburb_town"]);
		$state = $_POST["state"];
		$postcode = sanitise_input($_POST["postcode"]);
		$skills = isset($_POST["skill"]) ? $_POST["skill"] : array();
		$other_skill = isset($_POST["other-skills"]) ? sanitise_input($_POST["other-skills"]) : NULL;

		//Validate
		if (empty($job_reference_number)) {
			throw new Exception("Job Reference Number is missing");
		}
		
		if (!preg_match("/^[A-Za-z0-9]{5}$/", $job_reference_number)) {
			throw new Exception(format_invalid_error("Job Reference Number", "Invalid Job Reference Number"));
		}
		
		if (!preg_match("/^[A-Za-z]{1,20}$/", $first_name) || !preg_match("/^[A-Za-z]{1,20}$/", $last_name)) {
			throw new Exception(format_invalid_error("First Name and Last Name", "Your First Name and Last Name should only have <strong>letters</strong> and should not exceed <strong>20</strong> characters in length.")
			);
		}
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			throw new Exception(display_invalid_error("Email", "Invalid email address"));
		}
		
		if (!preg_match("/^[0-9\s]{8,12}$/", $phone_number)) {
			throw new Exception(display_invalid_error("Phone Number", "Invalid phone number"));
		}
		
		if (!date_validation($date_of_birth)) {
			throw new Exception(display_invalid_error("Date of Birth", "Wrong date format (dd/mm/yyyy) " . $date_of_birth));
		}
		
		if (!preg_match("/^.{1,40}$/", $street_address)) {
			throw new Exception(display_invalid_error("Street Address", "Only <strong>40</strong> words is acceptable in the street address."));
		}
		
		if (!preg_match("/^.{1,40}$/", $suburb_town)) {
			throw new Exception(display_invalid_error("Suburb/Town", "The suburb name you entered should not exceed <strong>40</strong> characters in length." . $suburb_town));
		}
		
		if (!age_validation($date_of_birth)) {
			throw new Exception(display_invalid_error("Date of Birth", "You have to be in the age group of 15 to 80 to apply the job"));
		}
		
		if (!preg_match("/^[0-9]{4}$/", $postcode)) {
			throw new Exception(display_invalid_error("Postcode", "Only <strong>4</strong> digits is acceptable in Postcode."));
		} else if (!validate_postcode($postcode, $state)) {
			throw new Exception(display_invalid_error("Postcode", "Invalid Postcode"));
		}
		
		if (empty($skills) && empty($other_skill)) {
			throw new Exception(display_missing_error("Skills"));
		}
		
		if (isset($_POST["skill"]) && in_array("others", $_POST["skill"]) && (empty($other_skill) || trim($other_skill) === "")) {
			throw new Exception(display_invalid_error("Skills", "Please provide the other skills you possessed"));
		}
		

		//Database
		require_once("./settings.php");

		$conn = @mysqli_connect(
			$host,
			$user,
			$pwd,
			$sql_db
		);

		if (!$conn) {
			die("Can not connect to the database: " . mysqli_connect_error());
		}		

		$mysqli_first_name = mysqli_real_escape_string($conn, $first_name);
		$mysqli_last_name = mysqli_real_escape_string($conn, $last_name);
		$mysqli_street_address = mysqli_real_escape_string($conn, $street_address);
		$mysqli_suburb_town = mysqli_real_escape_string($conn, $suburb_town);
		$mysqli_state = mysqli_real_escape_string($conn, $state);
		$mysqli_postcode = intval($postcode);
		$mysqli_email = mysqli_real_escape_string($conn, $email);
		$mysqli_phone_number = mysqli_real_escape_string($conn, $phone_number);
		$mysqli_gender = mysqli_real_escape_string($conn, $gender);
		$skill_html = in_array("HTML", $skills) ? "Yes" : "No";
		$skill_css = in_array("CSS", $skills) ? "Yes" : "No";
		$skill_javascript = in_array("Javascript", $skills) ? "Yes" : "No";
		$skill_php = in_array("PHP", $skills) ? "Yes" : "No";
		$skill_mysql = in_array("MySQL", $skills) ? "Yes" : "No";
		$other_skill = isset($_POST["other-skills"]) ? trim(sanitise_input($_POST["other-skills"])) : NULL;

			//Insert EOI records
		$insert_query = "INSERT INTO EOI (
			job_reference_number,
			email_address,
			first_name,
			last_name,
			gender,
			street_address,
			suburb_town,
			state,
			postcode,
			phone_number,
			skill_html,
			skill_css,
			skill_javascript,
			skill_php,
			skill_mysql,
			other_skill	
		) VALUES (
			'" . mysqli_real_escape_string($conn, $job_reference_number) . "',
			'$mysqli_email',
			'$mysqli_first_name',
			'$mysqli_last_name',
			'$mysqli_gender',
			'$mysqli_street_address',
			'$mysqli_suburb_town',
			'$mysqli_state',
			'$mysqli_postcode',
			'$mysqli_phone_number',
			'$skill_html',
			'$skill_css',
			'$skill_javascript',
			'$skill_php',
			'$skill_mysql',
			" . (!empty($other_skill) ? "'" . mysqli_real_escape_string($conn, $other_skill) . "'" : "NULL") . "
		)";
		$insert_result = mysqli_query($conn, $insert_query);

		if (!$insert_result) {
    		die("<p>Error: Can not submit the form" . mysqli_error($conn) . "</p>");
		}

		// Confirmation message
		echo "<p><strong>EOI has been submitted!</strong>";
		echo "<p><strong>Here is your EOI ID " . mysqli_insert_id($conn) . ".</strong></p>";

		echo "<p><a href='index.php'>Return Home</a></p>";
		unset($_SESSION["form_data"]);
	} catch (Exception $e) {
		echo "<p>Error: " . $e->getMessage() . "</p>";
	}
?>
</body>
</html>

<!-- Reference
https://www.w3schools.com/php/php_form_url_email.asp
https://www.w3schools.com/php/func_mysqli_real_escape_string.asp
 -->
 