<?php
session_start();
include "includes/dbh.inc.php";

if(!isset($_SESSION["seeker_id"]))
{
  header("location: seaman_login.php");
  exit;
}
if(!isset($_SESSION["seeker_pass"]))
{
  header("location: seaman_login.php");
  exit;
}
$id = $_SESSION["seeker_id"];
$pass = $_SESSION["seeker_pass"];

include 'includes/dashboard-header.inc.php';
include 'includes/sidenav.inc.php';

// Fetch all data from the database
$query = "SELECT * FROM job_seeker WHERE email = :email";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':email', $id);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
  $first_name = htmlspecialchars($result['first_name']);
  $prefer_job = htmlspecialchars($result['prefer_job']);
  $middle_name = htmlspecialchars($result['middle_name']);
  $last_name = htmlspecialchars($result['last_name']);
  $prefer_job = htmlspecialchars($result['prefer_job']);
  $city = htmlspecialchars($result['city']);
  $passport_country = htmlspecialchars($result['passport_country']);
  $passport_no = htmlspecialchars($result['passport_no']);
  $passport_issued = htmlspecialchars($result['passport_issued']);
  $passport_valid = htmlspecialchars($result['passport_valid']);
  $sbook_country = htmlspecialchars($result['sbook_country']);
  $sbook_no = htmlspecialchars($result['sbook_no']);
  $sbook_issued = htmlspecialchars($result['sbook_issued']);
  $sbook_valid = htmlspecialchars($result['sbook_valid']);
  $full_name = $first_name . ' ' . strtoupper(substr($middle_name, 0, 1)) . '. ' . $last_name;
  $cellphone = htmlspecialchars($result['cellphone']);
  $email = htmlspecialchars($result['email']);
  $birthday = htmlspecialchars($result['birthday']);
  $gender = htmlspecialchars($result['gender']);
  $seagoing_work = htmlspecialchars($result['seagoing_work']);
  $non_seagoing_work = htmlspecialchars($result['non_seagoing_work']);
  $competence = htmlspecialchars($result['competence']);
  $certificates = htmlspecialchars($result['certificates']);
  $merits = htmlspecialchars($result['merits']);
  $educ_training = htmlspecialchars($result['educ_training']);
  $view = htmlspecialchars($result['view']);
}
?>
<body>
<main>
    <h1 class="page-title">Update Profile</h1>
    <section class="container">
            <div class="container-controller">
              <div class="card mb-4">
                  <div class="card-header">Seaman Profile</div>
                  <div class="card-body">
                    <form action="includes/edit_seaman_profile_now.inc.php" method="post">
                        <h4 class="profile-header">General Information</h4>
                        <h6 class="name-position"><?php echo $full_name; ?></h6>

                          <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="cellphone">Phone number</label>
                                <input class="form-control" name="cellphone" id="cellphone" type="tel" placeholder="Enter your phone number" value="<?php echo $cellphone; ?>">
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="birthday">Birthday</label>
                                <input class="form-control" id="birthday" name="birthday" placeholder="Enter your birthday" value="<?php echo $birthday; ?>">
                            </div>
                          </div>
      
                          <div class="row gx-3 mb-3">
                              <!-- Form Group (gender)-->
                              <div class="col-md-6">
                                  <label class="small mb-1" for="gender">Gender</label>
                                  <input class="form-control" name="gender" id="gender" type="text" placeholder="Enter your Gender" value="<?php echo $gender; ?>">
                              </div>
                              <!-- Form Group (location)-->
                              <div class="col-md-6">
                                  <label class="small mb-1" for="city">Residence nearest City:</label>
                                  <input class="form-control" name="city" id="city" type="text" placeholder="Enter your location" value="<?php echo $city; ?>">
                              </div>
                          </div>

                        <!--------------------------------------- work experience ---------------------------------------->
                          <hr>
                          <h4 class="profile-header">Sea Going Experience</h4>
                            <textarea name="seagoing_work" rows="4" placeholder="Enter your Message" id="contact-form-input"><?php echo $seagoing_work; ?></textarea>

                        <!---------------------------------------- passport ---------------------------------------->
                          <hr>
                          <h4 class="profile-header">Passport </h4>
                              <div class="row gx-3 mb-3">
                                <!-- Form Group (country)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="passport_country">Country</label>
                                    <input class="form-control" name="passport_country" id="passport_country" type="text" value="<?php echo $passport_country; ?>">
                                </div>
                                <!-- Form Group (Issued)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="passport_issued">Issued</label>
                                    <input class="form-control" name="passport_issued" id="passport_issued" type="text" value="<?php echo $passport_issued; ?>">
                                </div>
                              </div>
          
                              <div class="row gx-3 mb-3">
                                  <!-- Form Group (No.)-->
                                  <div class="col-md-6">
                                      <label class="small mb-1" for="passport_no">No.</label>
                                      <input class="form-control" name="passport_no" id="passport_no" type="text" value="<?php echo $passport_no; ?>">
                                  </div>
                                  <!-- Form Group (valid)-->
                                  <div class="col-md-6">
                                      <label class="small mb-1" for="passport_valid">Valid</label>
                                      <input class="form-control" name="passport_valid" id="passport_valid" type="text" value="<?php echo $passport_valid; ?>">
                                  </div>
                              </div>

                          <!---------------------------------------- seamans book ---------------------------------------->
                          <hr>
                          <h4 class="profile-header">Seaman's Book </h4>
                              <div class="row gx-3 mb-3">
                                <!-- Form Group (country)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="sbook_country">Country</label>
                                    <input class="form-control" name="sbook_country" id="sbook_country" type="tel" value="<?php echo $sbook_country; ?>">
                                </div>
                                <!-- Form Group (Issued)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="sbook_issued">Issued</label>
                                    <input class="form-control" name="sbook_issued" id="sbook_issued" type="text" value="<?php echo $sbook_issued; ?>">
                                </div>
                              </div>
          
                              <div class="row gx-3 mb-3">
                                  <!-- Form Group (No.)-->
                                  <div class="col-md-6">
                                      <label class="small mb-1" for="sbook_no">No.</label>
                                      <input class="form-control" name="sbook_no" id="sbook_no" type="text" value="<?php echo $sbook_no; ?>">
                                  </div>
                                  <!-- Form Group (valid)-->
                                  <div class="col-md-6">
                                      <label class="small mb-1" for="sbook_valid">Valid</label>
                                      <input class="form-control" name="sbook_valid" id="sbook_valid" type="text" value="<?php echo $sbook_valid; ?>">
                                  </div>
                              </div>
                           <!----------------------------------------------- texbox area ---------------------------------------->
                            <hr>
                            <h4 class="profile-header">License Competency </h4>

                              <textarea name="competence" rows="4" placeholder="Enter your Message" id="contact-form-input"><?php echo $competence; ?></textarea>

                            <hr>
                            <h4 class="profile-header">Certificate </h4>
                              <textarea name="certificates" rows="4" placeholder="Enter your Message" id="contact-form-input"><?php echo $certificates; ?></textarea>

                            <hr>
                            <h4 class="profile-header">Education and training</h4>
                              <textarea name="educ_training" rows="4" placeholder="Enter your Message" id="contact-form-input"><?php echo $educ_training; ?></textarea>

                            <hr>
                            <h4 class="profile-header">Non sea going Work Experience</h4>
                              <textarea name="non_seagoing_work" rows="4" placeholder="Enter your Message" id="contact-form-input"><?php echo $non_seagoing_work; ?></textarea>

                            <hr>
                            <h4 class="profile-header">Merits Reward</h4>
                              <textarea name="merits" rows="4" placeholder="Enter your Message" id="contact-form-input"><?php echo $merits; ?></textarea>

                            <hr>
                            <h5 style="color: rgb(55, 54, 54);">Allow manning agency to view profile:</h5>
                            <input type="radio" id="view_yes" name="view" value="y" <?php echo ($view == 'y') ? 'checked' : ''; ?>>
                            <label for="view_yes" class="profile-label">Yes</label><br>
                            <input type="radio" id="view_no" name="view" value="n" <?php echo ($view == 'n') ? 'checked' : ''; ?>>
                            <label for="view_no" class="profile-label">No</label>
                          
                            <div class="password-form-control">
                              <label class="small mb-1" for="passwrd2">Current Password</label>
                              <input class="form-control" name="passwrd" type="password" id="passwrd2" placeholder="Enter your Password">
                            </div>

                          <hr>
                          <!-- Save changes button-->
                          <button class="btn btn-primary" type="submit">Save changes</button>
                    </form>
                  </div>
                </div>
            </div>
      </section>
  </main>  
  <?php include 'includes/body.inc.php';?>  
</body>
</html>
