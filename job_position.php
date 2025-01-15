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

// Fetch job categories and job positions from the database
$query = "SELECT category, job FROM seaman_jobs ORDER BY category ASC, job ASC";
$stmt = $pdo->prepare($query);
$stmt->execute();
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<body>
<main>
    <h1 class="page-title">Job Position Settings</h1>
    <section class="container">
      <div class="container-controller">
        <div class="card mb-4">
          <div class="card-header">Job Position</div>
            <div class="card-body">
                <form method="post" action="includes/edit_seaman_job_now.php" name="edit_seaman_job" id="edit_seaman_job" onsubmit="return validateForm_edit_seaman_job()">
                        
                        <!-- Form Group (Job position)-->
                        <h6 class="name-position">Current Job Position: <?php echo $prefer_job; ?></h6>
                        <hr>
                        <label class="small mb-1">Select new job position: </label><br>
                        <select name="job_prefer2" class="prefer-job">
                          <?php foreach ($jobs as $job): ?>
                            <option value="<?= htmlspecialchars($job['job']) ?>">
                                <?= htmlspecialchars($job['category']) . " - " . htmlspecialchars($job['job']) ?>
                            </option>
                          <?php endforeach; ?>
                        </select>

                        <!-- Form Group (password)-->
                        <div class="password-form-control">
                          <label class="small mb-1">Password</label>
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