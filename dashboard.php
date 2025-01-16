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
        <img src="images/city.jpg" class="card-img-top" alt="yourads2">
        <div class="card-body-job">
          <h6 class="company-name"><?php echo htmlspecialchars($job['company_name']); ?></h6>
          <h5 class="job-title"><?php echo htmlspecialchars($job['job_title']); ?></h5>
          <p class="card-text"><?php echo htmlspecialchars($job['job_description']); ?></p>
          <button type="button" class="btn btn-primary see-more-btn" data-toggle="modal" data-target="#dashboard-modal"
                  data-company-name="<?php echo htmlspecialchars($job['company_name']); ?>"
                  data-job-title="<?php echo htmlspecialchars($job['job_title']); ?>"
                  data-job-description="<?php echo htmlspecialchars($job['job_description']); ?>"
                  data-vessel-type="<?php echo htmlspecialchars($job['vessel']); ?>"
                  data-company-code="<?php echo htmlspecialchars($job['company_code']); ?>"
                  data-job-requirements="<?php echo htmlspecialchars($job['requirements']); ?>">See more</button>
        </div>
      </div>
      <?php endforeach; ?>
    </section>
    <form action="includes/apply_for_this_job_verify.inc.php" method="post">
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
                    <img src="images/wallem_logo.jpg" alt="Company Logo" id="modal-company-logo">
                    <h1 id="modal-company-name">Pacific Ocean Manning, Inc.</h1>
                  </div>
                  <div class="job-details">
                    <h4 class="job-title-modal" id="modal-job-title">Software Developer (Fresh Grads)</h4>
                    <h6 class="mb-0">Vessel Type: </h6>
                    <p class="job-description" id="modal-vessel-type">cargo type</p>
                    <h6 class="mb-0">Job description:</h6>
                    <p class="job-description" id="modal-job-description"> Developers/Programmers (Information &amp; Communication Technology)</p>
                    <h6 class="mb-0">Job requirements:</h6>
                    <p class="job-requirements" id="modal-job-requirements"> Full-time</p>

                    <div class="user-inputs">
                      <label for="email">Email</label>
                      <input name="job_seeker_id" type="email" id="email" class="form-control" placeholder="Enter your email">

                      <label for="password">Password</label>
                      <input name="job_seeker_password" type="password" id="password" class="form-control" placeholder="Enter your password">
                    </div>

                    <input type="hidden" name="job_title" id="modal-job-title-hidden">
                    <input type="hidden" name="company_code" id="modal-company-code-hidden">

                    <div class="actions">
                      <button type="submit" id="modal-company-code" class="btn btn-primary" name="submit2">Apply</button>
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
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const seeMoreButtons = document.querySelectorAll('.see-more-btn');
      seeMoreButtons.forEach(button => {
        button.addEventListener('click', function () {
          const companyName = this.getAttribute('data-company-name');
          const jobTitle = this.getAttribute('data-job-title');
          const jobDescription = this.getAttribute('data-job-description');
          const vesselType = this.getAttribute('data-vessel-type');
          const jobRequirements = this.getAttribute('data-job-requirements');
          const companyCode = this.getAttribute('data-company-code');

          document.getElementById('modal-company-name').textContent = companyName;
          document.getElementById('modal-job-title').textContent = jobTitle;
          document.getElementById('modal-job-description').textContent = jobDescription;
          document.getElementById('modal-vessel-type').textContent = vesselType;
          document.getElementById('modal-job-requirements').textContent = jobRequirements;
          document.getElementById('modal-job-title-hidden').value = jobTitle;
          document.getElementById('modal-company-code-hidden').value = companyCode;
        });
      });
    });
  </script>
</body>
</html>
