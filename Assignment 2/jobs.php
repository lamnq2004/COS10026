<!DOCTYPE html>
<html lang="en">


<?php $title = "Job Applications";
include('head.inc'); ?>

<body>

  <?php include('header.inc'); ?>

  <h1 class="jobs-heading">Job Descriptions</h1>

  <?php

  $host = "feenix-mariadb.swin.edu.au";
  $user = "s104477381"; // your user name
  $pwd = "150805"; // your password (date of birth ddmmyy unless changed)
  $sql_db = "s104477381_db"; // your database
  
  $conn = @mysqli_connect(
    $host,
    $user,
    $pwd,
    $sql_db
  );

  if (!$conn) {
    echo "<p>Database connection failure</p>";
  } else {

    $query = "SELECT * FROM job_descriptions";
    $result = mysqli_query($conn, $query);

    while ($job = mysqli_fetch_assoc($result)) { ?>

      <aside class="job-desc">
        <h3 class="orange-subheaders">Position Number</h3>
        <h3 class="black-subheaders">
          <?= $job['position_number'] ?>
        </h3>
        <h3 class="orange-subheaders">Team</h3>
        <h3 class="black-subheaders">
          <?= $job['team'] ?>
        </h3>
        <h3 class="orange-subheaders">Location</h3>
        <h3 class="black-subheaders">
          <?= $job['location'] ?>
        </h3>
        <h3 class="orange-subheaders">Salary</h3>
        <h3 class="black-subheaders">
          <?= $job['salary'] ?>
        </h3>
        <h3 class="orange-subheaders">Reporting Manager</h3>
        <h3 class="black-subheaders">
          <?= $job['reporting_manager'] ?>
        </h3>
      </aside>
      <section class="jobs-section">
        <h2 class="position-description">
          <?= $job['position_description'] ?>
        </h2>
        <h3 class="subhead">The Role</h3>
        <p class="positions-body-text">
          <?= $job['role_description'] ?>
        </p>
        <h3 class="subhead">Key Responsibilities:</h3>
        <ol class="positions-body-text">
          <?php
          $responsibilities = explode("\n", $job['key_responsibilities']);
          foreach ($responsibilities as $responsibility) {
            echo "<li>" . $responsibility . "</li>";
          }
          ?>
        </ol>
        <h3 class="position-description">About You</h3>
        <h4 class="subhead">Essential Qualifications:</h4>
        <ul class="positions-body-text">
          <?php
          $qualifications = explode("\n", $job['about_you']);
          foreach ($qualifications as $qualification) {
            echo "<li>" . $qualification . "</li>";
          }
          ?>
        </ul>
        <h4 class="subhead">Desirable Qualifications:</h4>
        <ul class="positions-body-text">
          <?php
          $qualifications = explode("\n", $job['desirable_qualifications']);
          foreach ($qualifications as $qualification) {
            echo "<li>" . $qualification . "</li>";
          }
          ?>
        </ul>
        <h3 class="positions-body-text">Sound like you? We'd love to hear from you!</h3>
        <p class="positions-body-text">
          <a href="apply.php">Apply Now!</a>
          <a href="mailto:Curlybracetechnologies@outlook.com">Have a question? Contact us here</a>
        </p>
      </section>

    <?php }

    mysqli_close($conn);

  } ?>

  <?php include('footer.inc'); ?>

</body>

</html>