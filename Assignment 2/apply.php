<!DOCTYPE html>
<html lang="en">

<?php $title = "Job Application";
include('head.inc'); ?>

<body>

  <?php include('header.inc'); ?>

  <div class="apply">
    <h1>Application Form</h1>
    <p class="comment">
      Please fill out the form below, an agent will review your application
      within 24 - 48 business hours.
    </p>

    <form method="post" action="processEOI.php">
      <fieldset class="hideborder">
        <fieldset class="hideborder">
          <label for="job_reference_number">Job Reference Number</label>
          <p>Please fill in your Job Reference Number :</p>
          <input type="text" name="job_reference_number" id="job_reference_number" required="required"
            pattern="[0-9]{5}" />
        </fieldset>

        <fieldset class="form-section">
          <legend>Personal Details</legend>
          <p>Please fill in your personal details</p>

          <label for="first_name">First Name</label>
          <input type="text" name="first_name" id="first_name" required="required" pattern="[a-zA-Z]{1,20}" />

          <label for="last_name">Last Name</label>
          <input type="text" name="last_name" id="last_name" required="required" pattern="[a-zA-Z]{1,20}" />

          <label for="date_of_birth" Date> Date Of Birth</label>
          <input type="text" name="date_of_birth" id="date_of_birth" pattern="\d{2}/\d{2}/\d{4}"
            placeholder="dd/mm/yyyy" />

          <fieldset id="gender-fieldset">
            <legend>Gender</legend>
            <input id="male" type="radio" name="gender" value="Male" required="required" />
            <label for="male">Male</label>
            <input id="female" type="radio" name="gender" value="Female" />
            <label for="female">Female</label>
            <input id="other" type="radio" name="gender" value="Other" />
            <label for="other">Other</label>
          </fieldset>
        </fieldset>

        <fieldset class="form-section">
          <legend>Address Details</legend>
          <p>Please fill out your addressing details below</p>

          <label for="street_address">Street Address</label>
          <input type="text" name="street_address" id="street_address" required="required"
            pattern="[a-zA-Z0-9 ]{1,40}" />

          <label for="suburb_town">Suburb/Town</label>
          <input type="text" name="suburb_town" id="suburb_town" required="required" pattern="[a-zA-Z0-9 ]{1,40}" />

          <label for="postcode">Postcode </label>
          <input type="text" name="postcode" id="postcode" required="required" pattern="[0-9]{4}" />

          <label for="state">State</label>
          <select name="state" id="state">
            <option value=" " selected="selected"></option>
            <option value="VIC">VIC</option>
            <option value="NSW">NSW</option>
            <option value="QLD">QLD</option>
            <option value="NT">NT</option>
            <option value="WA">WA</option>
            <option value="SA">SA</option>
            <option value="TAS">TAS</option>
            <option value="ACT">ACT</option>
          </select>
        </fieldset>

        <fieldset class="form-section">
          <legend>Contact Details</legend>
          <p>Please fill out your contact details below :</p>

          <label for="email">Email Address</label>
          <input id="email" type="email" name="email" required="required"
            pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" />

          <label for="phone_number">Phone Number</label>
          <input id="phone_number" type="text" name="phone_number" required="required"
            pattern="^\({0,1}((0|\+61)(2|4|3|7|8)){0,1}\){0,1}( |-){0,1}[0-9]{2}( |-){0,1}[0-9]{2}( |-){0,1}[0-9]{1}( |-){0,1}[0-9]{3}$" />
        </fieldset>

        <fieldset class="form-section" id="skills">
          <legend>Skills</legend>
          <p>Please Select all valid skills</p>

          <label><input type="checkbox" name="skill[]" value="HTML" checked="checked" />HTML</label>

          <label><input type="checkbox" name="skill[]" value="CSS" />CSS</label>

          <label><input type="checkbox" name="skill[]" value="Javascript" />Javascript</label>

          <label><input type="checkbox" name="skill[]" value="PHP" />PHP</label>

          <label><input type="checkbox" name="skill[]" value="MySQL" />MySQL</label>

          <label><input type="checkbox" name="skill[]" value="Other Skills" />Other
            Skills</label>

          <label for="other_skill">Input Other Skills:</label>
          <textarea id="other_skill" name="other_skill" rows="5" cols="40" placeholder="Other skills..."></textarea>
        </fieldset>

        <fieldset>
          <input type="submit" value="Submit Application" />
          <input type="reset" value="Reset Form" />
        </fieldset>
      </fieldset>
    </form>
  </div>

  <?php include('footer.inc'); ?>

</body>

</html>