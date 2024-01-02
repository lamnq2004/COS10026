<!DOCTYPE html>
<html lang="en">


<?php $title = "HR Search";
include('head.inc'); ?>

<body>
  <?php include('header.inc'); ?>

  <?php
  function generateSortFieldDropdown()
  {
    $columns = [
      'eoi_number' => 'EOI Number',
      'job_reference_number' => 'Job Reference Number',
      'first_name' => 'First Name',
      'last_name' => 'Last Name',
      'gender' => 'Gender',
      'street_address' => 'Street Address',
      'suburb_town' => 'Suburb/Town',
      'state' => 'State',
      'postcode' => 'Postcode',
      'email_address' => 'Email Address',
      'phone_number' => 'Phone Number',
      'skill_html' => 'HTML Skill',
      'skill_css' => 'CSS Skill',
      'skill_javascript' => 'JavaScript Skill',
      'skill_php' => 'PHP Skill',
      'skill_mysql' => 'MySQL Skill',
      'skill_other' => 'Other Skill',
      'other_skill' => 'Other Skill Description',
      'status' => 'Status'
    ];

    echo '<label for="sort_field">Sort By:</label>';
    echo '<select name="sort_field" id="sort_field">';
    foreach ($columns as $key => $value) {
      $selected = ($key == 'eoi_number') ? 'selected' : '';
      echo "<option value=\"$key\" $selected>$value</option>";
    }
    echo '</select>';
  }
  ?>

  <div class="apply manage">
    <h1>Human Resources Queries</h1>
    <!-- Query 1: List all EOIs -->
    <h4>List all EOIs</h4>
    <form action="processManage.php" method="post">
      <input type="hidden" name="action" value="listAllEOIs">
      <?php generateSortFieldDropdown(); ?>
      <input type="submit" value="List All EOIs">
    </form>

    <h4>List EOIs by Job Reference Number</h4>
    <form action="processManage.php" method="post">
      <input type="hidden" name="action" value="listEOIsByJobRef">
      <label for="job_reference">Job Reference Number:</label>
      <input type="text" id="job_reference" name="job_reference">
      <?php generateSortFieldDropdown(); ?>
      <input type="submit" value="List EOIs">
    </form>

    <h4>List EOIs by Applicant Name</h4>
    <form action="processManage.php" method="post">
      <input type="hidden" name="action" value="listEOIsByApplicantName">
      <label for="first_name">First Name:</label>
      <input type="text" id="first_name" name="first_name">
      <label for="last_name">Last Name:</label>
      <input type="text" id="last_name" name="last_name">
      <?php generateSortFieldDropdown(); ?>
      <input type="submit" value="List EOIs">
    </form>

    <h4>Delete EOIs by Job Reference Number</h4>
    <form action="processManage.php" method="post">
      <input type="hidden" name="action" value="deleteEOIsByJobRef">
      <label for="job_reference_delete">Job Reference Number:</label>
      <input type="text" id="job_reference_delete" name="job_reference">
      <input type="submit" value="Delete EOIs">
    </form>

    <h4>Change EOI Status</h4>
    <form action="processManage.php" method="post">
      <input type="hidden" name="action" value="changeEOIStatus">
      <label for="eoi_id">EOI ID:</label>
      <input type="text" id="eoi_id" name="eoi_id">
      <label for="new_status">New Status:</label>

      <select name="new_status" id="new_status">
        <option value="New" selected="selected">New</option>
        <option value="Current">Current</option>
        <option value="Final">Final</option>
      </select>

      <input type="submit" value="Change Status">
    </form>

  </div>
  <?php include('footer.inc'); ?>
</body>

</html>