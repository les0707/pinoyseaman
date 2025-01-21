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

$datenow = date('Y-m-d');

// Pagination logic
$limit = 8; // Number of jobs per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get the total number of jobs
$total_query = "SELECT COUNT(*) FROM jobs WHERE expiry > :datenow AND mark='y'";
$total_stmt = $pdo->prepare($total_query);
$total_stmt->bindParam(':datenow', $datenow);
$total_stmt->execute();
$total_jobs = $total_stmt->fetchColumn();
$total_pages = ceil($total_jobs / $limit);

// Fetch jobs for the current page
$query = "SELECT * FROM jobs WHERE expiry > :datenow AND mark='y' ORDER BY company_name ASC LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':datenow', $datenow);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<body>
<main>
    <h1 class="page-title">Available jobs</h1>
    <section class="container" >
      <?php foreach ($jobs as $job): ?>
        <?php
          // Fetch the logo from the employer table
          $company_code = $job['company_code'];
          $logo_query = "SELECT logo FROM employer WHERE company_code = :company_code";
          $logo_stmt = $pdo->prepare($logo_query);
          $logo_stmt->bindParam(':company_code', $company_code);
          $logo_stmt->execute();
          $logo_result = $logo_stmt->fetch(PDO::FETCH_ASSOC);
          $logo = $logo_result ? 'logo/' . htmlspecialchars($logo_result['logo']) : 'logo/city.jpg';
        ?>
        <div class="card" style="width: 15rem;" id="card">
          <img src="<?php echo $logo; ?>" class="card-img-top" alt="Company Logo">
          <div class="card-body-job">
            <h6 class="company-name"><?php echo htmlspecialchars($job['company_name']); ?></h6>
            <h5 class="job-title"><?php echo htmlspecialchars($job['job_title']); ?></h5>
            
            <button type="button" class="btn btn-primary see-more-btn" data-toggle="modal" data-target="#dashboard-modal"
                    data-company-name="<?php echo htmlspecialchars($job['company_name']); ?>"
                    data-job-title="<?php echo htmlspecialchars($job['job_title']); ?>"
                    data-job-description="<?php echo htmlspecialchars($job['job_description']); ?>"
                    data-vessel-type="<?php echo htmlspecialchars($job['vessel']); ?>"
                    data-company-code="<?php echo htmlspecialchars($job['company_code']); ?>"
                    data-job-requirements="<?php echo htmlspecialchars($job['requirements']); ?>"
                    data-logo="<?php echo $logo; ?>">See more</button>
          </div>
        </div>
      <?php endforeach; ?>

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

    <!-- Pagination controls -->
    <nav aria-label="Page navigation" class="d-flex justify-content-center mt-4">
      <ul class="pagination">
        <?php if ($page > 1): ?>
          <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a></li>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
          <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php endfor; ?>
        <?php if ($page < $total_pages): ?>
          <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a></li>
        <?php endif; ?>
      </ul>
    </nav>

    </section>

    
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
          const logo = this.getAttribute('data-logo');

          document.getElementById('modal-company-name').textContent = companyName;
          document.getElementById('modal-job-title').textContent = jobTitle;
          document.getElementById('modal-job-description').textContent = jobDescription;
          document.getElementById('modal-vessel-type').textContent = vesselType;
          document.getElementById('modal-job-requirements').textContent = jobRequirements;
          document.getElementById('modal-job-title-hidden').value = jobTitle;
          document.getElementById('modal-company-code-hidden').value = companyCode;
          document.getElementById('modal-company-logo').src = logo;
        });
      });
    });
  </script>
</body>
</html>