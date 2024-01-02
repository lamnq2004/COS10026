<?php
function date_validation($date)
{
	$date_format = "d/m/Y";

	//check whether input date is in correct format
	$date_obj = DateTime::createFromFormat($date_format, $date);
	if ($date_obj === false) {
		// Invalid date format
		return false;
	}

	// Check if the date is valid
	$day = $date_obj->format('d');
	$month = $date_obj->format('m');
	$year = $date_obj->format('Y');
	if (!checkdate($month, $day, $year) || $date_obj->format($date_format) !== $date) {
		// Invalid date
		return false;
	}

	return true;
}

function age_validation($date)
{
	$date_format = "d/m/Y";
	$min_age = 15;
	$max_age = 80;

	$date_obj = DateTime::createFromFormat($date_format, $date);

	if ($date_obj === false) {
		// Invalid date format
		return false;
	}

	// Calculate the age
	$today = new DateTime();

	if ($date_obj < $today) {
		$diff = $today->diff($date_obj);
		// Retrieve the number of years
		$age = $diff->y;

		return $age >= $min_age && $age <= $max_age;
	}

	return false;
}

$postcode_validation = [
	"VIC" => "/^3/",
	"NSW" => "/^1|2/",
	"QLD" => "/^4|9/",
	"NT" => "/^08/",
	"WA" => "/^6/",
	"SA" => "/^5/",
	"TAS" => "/^7/",
	"ACT" => "/^0/"
];

function validate_postcode($postcode, $state)
{
	return preg_match($GLOBALS["postcode_validation"][$state], $postcode);
}

function display_missing_error($field)
{
	return sprintf("<p><strong>Missing field: %s </strong></p>", $field);
}

function display_invalid_error($field, $message)
{
	return sprintf("<p><strong>Invalid field: %s </strong> %s</p>", $field, $message);
}

// REFERENCE
// https://postcodes-australia.com/state-postcodes/nsw
// https://stackoverflow.com/questions/676824/how-to-calculate-the-difference-between-two-dates-using-php