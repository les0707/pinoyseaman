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

// $first_name = "Name";
// $prefer_job = "Job Position";
// $full_name = "Full Name";
if ($result) {
  $first_name = htmlspecialchars($result['first_name']);
  $prefer_job = htmlspecialchars($result['prefer_job']);
  $middle_name = htmlspecialchars($result['middle_name']);
  $last_name = htmlspecialchars($result['last_name']);
  $prefer_job = htmlspecialchars($result['prefer_job']);
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
}
?>

<body>
<main>
  <h1 class="page-title">My Profile</h1>
  <section class="container">
  <div class="row gutters-sm">
    <div class="col-md-4 mb-3">
    <div class="card">
      <div class="card-body">
      <div class="d-flex flex-column align-items-center text-center">
        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
        <div class="mt-3">
        <h4 style="color: black;">Hi, <?php echo $first_name; ?>!</h4>
        <p class="text-secondary mb-1"><?php echo $prefer_job; ?></p>
        <div class="col-sm-12">
          <a class="btn btn-primary" href="job_position.php">Update job position</a>
        </div>
        </div>
      </div>
      </div>
    </div>
    <div class="card mt-3">
      <ul class="list-group list-group-flush">
      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
        <h5 style="color: black;">Passport</h5>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
        <h6 class="mb-0">Country: </h6>
        <span class="text-secondary"><?php echo $passport_country; ?></span>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
        <h6 class="mb-0">No: </h6>
        <span class="text-secondary"><?php echo $passport_no; ?></span>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
        <h6 class="mb-0">Issued: </h6>
        <span class="text-secondary"><?php echo $passport_issued; ?></span>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
        <h6 class="mb-0">Valid: </h6>
        <span class="text-secondary"><?php echo $passport_valid; ?></span>
      </li>

      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
        <h5 style="color: black">Seaman's Book</h5>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
        <h6 class="mb-0">Country: </h6>
        <span class="text-secondary"><?php echo $sbook_country; ?></span>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
        <h6 class="mb-0">No: </h6>
        <span class="text-secondary"><?php echo $sbook_no; ?></span>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
        <h6 class="mb-0">Issued: </h6>
        <span class="text-secondary"><?php echo $sbook_issued; ?></span>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
        <h6 class="mb-0">Valid: </h6>
        <span class="text-secondary"><?php echo $sbook_valid; ?></span>
      </li>
      </ul>
    </div>
    </div>
    <div class="col-md-8">
    <div class="card mb-3">
      <div class="card-body">

      <div class="row">
        <h6 style="color: black; margin-left: 10px;">General Information</h6>
      </div>

      <hr>
      <div class="row">
        <div class="col-sm-3">
        <h6 class="mb-0">Fullname:</h6>
        </div>
        <div class="col-sm-9 text-secondary">
          <?php echo $full_name; ?>
        </div>
      </div>

      <hr>
      <div class="row">
        <div class="col-sm-3">
        <h6 class="mb-0">Phone:</h6>
        </div>
        <div class="col-sm-9 text-secondary">
          <?php echo $cellphone; ?>
        </div>
      </div>

      <hr>
      <div class="row">
        <div class="col-sm-3">
        <h6 class="mb-0">Email:</h6>
        </div>
        <div class="col-sm-9 text-secondary">
          <?php echo $email; ?>
        </div>
      </div>

      <hr>
      <div class="row">
        <div class="col-sm-3">
        <h6 class="mb-0">Date of birth:</h6>
        </div>
        <div class="col-sm-9 text-secondary">
          <?php echo $birthday; ?>
        </div>
      </div>

      <hr>
      <div class="row">
        <div class="col-sm-3">
        <h6 class="mb-0">Gender:</h6>
        </div>
        <div class="col-sm-9 text-secondary">
          <?php echo $gender; ?>
        </div>
      </div>
      </div>
    </div>

    <div class="row gutters-sm">
      <div class="col-sm-6 mb-3">
      <div class="card h-100">
        <div class="card-body">

        <h5 style="color: rgb(55, 54, 54)">Sea going Experience</h5>
        <hr>
          <p>
            <?php echo $seagoing_work; ?>
          </p>
        <hr>
          
        <h5 style="color: rgb(55, 54, 54)">Non-Sea going Experience</h5>
        <hr>
          <p>
            <?php echo $non_seagoing_work; ?>
          </p>
        <hr>

        <h5 style="color: rgb(55, 54, 54)">License, Competency, U.S Visa, Schegan Visa</h5>
        <hr>
          <p>
            <?php echo $competence; ?>
          </p>
        <hr>

        </div>
      </div>
      </div>
      <div class="col-sm-6 mb-3">
      <div class="card h-100">
        <div class="card-body">

        <h5 style="color: rgb(55, 54, 54)">Education and training</h5>
        <hr>
          <p>
            <?php echo $educ_training; ?>
          </p>
        <hr>

        <h5 style="color: rgb(55, 54, 54)">Certificates</h5>
        <hr>
          <p>
            <?php echo $certificates; ?>
          </p>
        <hr>

        <h5 style="color: rgb(55, 54, 54)">Merits, Rewards, Titles, Hobbies, Interests</h5>
        <hr>
          <p>
            <?php echo $merits; ?>
          </p>
        <hr>
        </div>
      </div>
      </div>
    </div>
  </section>
  </main>

  <?php include 'includes/body.inc.php';?>
</body>
</html>
