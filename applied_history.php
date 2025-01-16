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
$query = "SELECT * FROM job_applicants WHERE email = :email AND mark != 'x' ORDER BY company ASC";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':email', $id);
$stmt->execute();
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
<main>
    <h1 class="page-title">Applied History</h1>
    <section class="container">
      <?php foreach ($jobs as $job): ?>
        <div class="card" style="width: 15rem;" id="card">
          <img src="images/city.jpg" class="card-img-top" alt="yourads2">
          <div class="card-body-job">
            <h6 class="company-name"><?php echo htmlspecialchars($job['company']); ?></h6>
            <h5 class="job-title"><?php echo htmlspecialchars($job['job_hiring']); ?></h5>
            <button type="button" class="btn btn-primary see-more-btn" data-toggle="modal" data-target="#dashboard-modal"
                    data-company-name="<?php echo htmlspecialchars($job['company']); ?>"
                    data-job-hiring="<?php echo htmlspecialchars($job['job_hiring']); ?>"
                    data-company-code="<?php echo htmlspecialchars($job['company_code']); ?>">Cancel my Application</button>
          </div>
        </div>
      <?php endforeach; ?>
    </section>
    <form action="includes/cancel_apply.inc.php" method="get">
      <!------------------ Modal for dashboard ----------------->
      <div class="modal fade" id="dashboard-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-m">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cancel Application</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="job-card">
                  <div class="header">
                    <h1 id="modal-company-name">Company Name</h1>
                  </div>
                  <div class="job-details">
                    <h4 class="job-title-modal" id="modal-job-hiring">Job Title</h4>
                    <p id="confirmation-message">Are you sure you want to cancel your application at <span id="modal-company-name-confirm"></span> with the job title of <span id="modal-job-hiring-confirm"></span>?</p>
                    <input name="cancel_code" id="modal-company-code-hidden">
                    <div class="actions">
                      <button type="submit" class="btn btn-danger" name="submit2">Cancel Application</button>
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
          const jobHiring = this.getAttribute('data-job-hiring');
          const companyCode = this.getAttribute('data-company-code');

          document.getElementById('modal-company-name').textContent = companyName;
          document.getElementById('modal-job-hiring').textContent = jobHiring;
          document.getElementById('modal-company-code-hidden').value = companyCode;
          document.getElementById('modal-company-name-confirm').textContent = companyName;
          document.getElementById('modal-job-hiring-confirm').textContent = jobHiring;
        });
      });
    });
  </script>
</body>
</html>