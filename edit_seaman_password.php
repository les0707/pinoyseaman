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
    <h1 class="page-title">Change Password</h1>
    <section class="container">
            <div class="container-controller">
              <div class="card mb-4">
                  <div class="card-header">Change Password</div>
                  <div class="card-body">
                      <form action="includes/edit_seaman_password_now.inc.php" method="post">
                          <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1">Change password</label>
                                <input class="form-control" name="password" type="password" placeholder="New password">
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1">Confirm new password</label>
                                <input class="form-control" name="password2" type="password" placeholder="Re-enter new password">
                            </div>
                          </div>
    
                          <div class="password-form-control">
                              <label class="small mb-1">Current password</label>
                              <input class="form-control" name="old_password" type="password" placeholder="Current password">
                          </div>

                          <hr>
                          <!-- Save changes button-->
                          <button class="btn btn-primary" name="Submit" type="submit">Change password</button>
                      </form>
                  </div>
                </div>
            </div>
      </section>
  </main>
  <?php include 'includes/body.inc.php';?>
</body>
</html>