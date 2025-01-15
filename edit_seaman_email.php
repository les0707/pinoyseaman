<?php
session_start();
include "includes/dbh.inc.php";

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if(!isset($_SESSION["seeker_id"])) {
  header("location: seaman_login.php");
  exit;
}
if(!isset($_SESSION["seeker_pass"])) {
  header("location: seaman_login.php");
  exit;
}
$id = $_SESSION["seeker_id"];
$pass = $_SESSION["seeker_pass"];

include 'includes/dashboard-header.inc.php';
include 'includes/sidenav.inc.php';
?>
<body>
<main>
    <h1 class="page-title">Update Email</h1>
    <section class="container">
            <div class="container-controller">
              <div class="card mb-4">
                  <div class="card-header">Update Email Address</div>
                  <div class="card-body">
                        <form action="includes/edit_seaman_email_now.inc.php" method="post">
                          <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1">New Email</label>
                                <input class="form-control" name="new_email" type="email" placeholder="Enter new email address">
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1">Confirm Email Address</label>
                                <input class="form-control" name="new_email2" type="email" placeholder="Re-type new email address">
                            </div>
                          </div>
    
                          <div class="password-form-control">
                              <label class="small mb-1">Password</label>
                              <input class="form-control" name="passwrd" type="password" id="passwrd2" placeholder="Enter your Password">
                          </div>

                          <hr>
                          <!-- Save changes button-->
                          <button class="btn btn-primary" name="Submit" type="submit">Save changes</button>
                        </form>
                  </div>
                </div>
            </div>
      </section>
  </main>
  <?php include 'includes/body.inc.php';?>
</body>
</html>