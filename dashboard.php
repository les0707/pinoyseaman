<?php
session_start();
include "includes/dbh.inc.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

// Fetch all data from the database
$query = "SELECT * FROM job_seeker WHERE email = :email";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':email', $id);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
  $prefer_job = htmlspecialchars($result['prefer_job']);
}

$datenow = date('Y-m-d');
$query = "SELECT * FROM jobs WHERE job_title = :prefer_job AND expiry > :datenow AND mark='y' ORDER BY company_name ASC";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':prefer_job', $prefer_job);
$stmt->bindParam(':datenow', $datenow);
$stmt->execute();
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<body>
<main>
    <h1 class="page-title">Based on your job position</h1>
    <section class="container">
      <?php foreach ($jobs as $job): ?>
      <div class="card" style="width: 15rem;" id="card">
        <img src="ads/yourads2.jpg" class="card-img-top" alt="yourads2">
        <div class="card-body-job">
          <h6 class="company-name"><?php echo htmlspecialchars($job['company_name']); ?></h6>
          <h5 class="job-title"><?php echo htmlspecialchars($job['job_title']); ?></h5>
          <p class="card-text"><?php echo htmlspecialchars($job['job_description']); ?></p>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dashboard-modal">See more</button>
        </div>
      </div>
      <?php endforeach; ?>
    </section>
    <form action="#">
      <!------------------ Modal for dashboard ----------------->
      <div class="modal fade" id="dashboard-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Job Posting</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="job-card">
                  <div class="header">
                    <img src="images/wallem_logo.jpg" alt="Company Logo">
                    <h1>Pacific Ocean Manning, Inc.</h1>
                  </div>
                  <div class="job-details">
                    <h4 class="job-title-modal">Software Developer (Fresh Grads)</h4>
                    <h6 class="mb-0">Vessel Type: </h6>
                    <p class="job-description">cargo type</p>
                    <h6 class="mb-0">Job description:</h6>
                    <p class="job-description"> Developers/Programmers (Information &amp; Communication Technology)</p>
                    <h6 class="mb-0">Job reqiurements:</h6>
                    <p class="job-requirements"> Full-time</p>

                    <div class="user-inputs">
                      <label for="email">Email</label>
                      <input name="job_seeker_id" type="email" id="email" class="form-control" placeholder="Enter your email">

                      <label for="password">Password</label>
                      <input name="job_seeker_password" type="password" id="password" class="form-control" placeholder="Enter your password">
                    </div>

                    <div class="actions">
                      <button class="btn btn-primary" name="submit2">Apply</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
    </form>
  </main>
  <?php include 'includes/body.inc.php';?>
</body>
</html>
