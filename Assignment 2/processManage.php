<!DOCTYPE html>
<html lang="en">


<?php $title = "Retrieving Records";
include('head.inc'); ?>

<body>
    <h1> Human Resources - Queries </h1>
    <?php
    require_once("settings.php");

    $conn = @mysqli_connect(
        $host,
        $user,
        $pwd,
        $sql_db
    );

    $table = 'EOI';

    if (!$conn) {
        echo "<p>Database connection failure </p>";
    } else {

        require_once("./utility.php");

        // Function to display EOIs in a table
        function displayEOIs($result)
        {
            if (mysqli_num_rows($result) > 0) {
                echo "<table border='1'>";
                echo "<tr><th>EOI Number</th><th>Job Reference Number</th><th>First Name</th><th>Last Name</th><th>Gender</th><th>Street Address</th><th>Suburb/Town</th><th>State</th><th>Postcode</th><th>Email Address</th><th>Phone Number</th><th>HTML Skill</th><th>CSS Skill</th><th>JavaScript Skill</th><th>PHP Skill</th><th>MySQL Skill</th><th>Other Skill</th><th>Other Skill Description</th><th>Status</th></tr>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['eoi_number']}</td>";
                    echo "<td>{$row['job_reference_number']}</td>";
                    echo "<td>{$row['first_name']}</td>";
                    echo "<td>{$row['last_name']}</td>";
                    // echo "<td>{$row['date_of_birth']}</td>";
                    echo "<td>{$row['gender']}</td>";
                    echo "<td>{$row['street_address']}</td>";
                    echo "<td>{$row['suburb_town']}</td>";
                    echo "<td>{$row['state']}</td>";
                    echo "<td>{$row['postcode']}</td>";
                    echo "<td>{$row['email_address']}</td>";
                    echo "<td>{$row['phone_number']}</td>";
                    echo "<td>{$row['skill_html']}</td>";
                    echo "<td>{$row['skill_css']}</td>";
                    echo "<td>{$row['skill_javascript']}</td>";
                    echo "<td>{$row['skill_php']}</td>";
                    echo "<td>{$row['skill_mysql']}</td>";
                    echo "<td>{$row['skill_other']}</td>";
                    echo "<td>{$row['other_skill']}</td>";
                    echo "<td>{$row['status']}</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "No EOIs found.";
            }
        }

        function listAndSortEOIs($conn, $query, $sortField, $title)
        {
            $query .= " ORDER BY $sortField";
            $result = mysqli_query($conn, $query);

            echo "<h2>$title (Sorted by $sortField)</h2>";
            displayEOIs($result);
        }

        $sortField = isset($_POST['sort_field']) ? sanitise_input($_POST['sort_field']) : 'eoi_number';

        // Check if a specific action was submitted
        if (isset($_POST['action'])) {
            $action = sanitise_input($_POST['action']);

            if ($action === 'listAllEOIs') {
                $query = "SELECT * FROM $table";
                $result = mysqli_query($conn, $query);
                listAndSortEOIs($conn, $query, $sortField, "List of All EOIs");

            } elseif ($action === 'listEOIsByJobRef') {
                $jobReference = sanitise_input($_POST['job_reference']);
                $query = "SELECT * FROM $table WHERE job_reference_number = '$jobReference'";
                $result = mysqli_query($conn, $query);
                listAndSortEOIs($conn, $query, $sortField, "<h2>EOIs for Job Reference: $jobReference</h2>");

            } elseif ($action === 'listEOIsByApplicantName') {
                $firstName = sanitise_input($_POST['first_name']);
                $lastName = sanitise_input($_POST['last_name']);
                $query = "SELECT * FROM $table WHERE first_name = '$firstName' OR last_name = '$lastName'";
                $result = mysqli_query($conn, $query);
                listAndSortEOIs($conn, $query, $sortField, "<h2>EOIs for Applicant: $firstName $lastName</h2>");

            } elseif ($action === 'deleteEOIsByJobRef') {
                $jobReference = sanitise_input($_POST['job_reference']);
                $deleteQuery = "DELETE FROM $table WHERE job_reference_number = '$jobReference'";
                $deleteResult = mysqli_query($conn, $deleteQuery);

                if ($deleteResult) {
                    echo "EOIs with job reference number $jobReference deleted successfully.";
                } else {
                    echo "Error deleting EOIs with job reference number $jobReference.";
                }

            } elseif ($action === 'changeEOIStatus') {
                // Get the EOI ID and new status from the form input
                $eoiID = sanitise_input($_POST['eoi_id']);
                $newStatus = sanitise_input($_POST['new_status']);

                // Query to change the status of an EOI
                $updateQuery = "UPDATE $table SET status = '$newStatus' WHERE eoi_number = $eoiID";
                $updateResult = mysqli_query($conn, $updateQuery);

                if ($updateResult) {
                    echo "EOI status updated successfully.";
                } else {
                    echo "Error updating EOI status.";
                }
            }
        }

        mysqli_close($conn);
    }

    ?>


</body>


</html>