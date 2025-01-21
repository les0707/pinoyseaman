<?php
session_start();
include "dbh.inc.php";

if (!isset($_SESSION["employer_login"]) || !isset($_SESSION["employer_pass"])) {
  header("location: employer_login.php");
  exit;
}

$employer_id = $_SESSION["employer_login"];
$employer_password = $_SESSION["employer_pass"];
$employer_company = $_SESSION["employer_company"];
$expiry_date = $_SESSION["employer_expiry_date"];
$employer_email = $_SESSION["employer_email"];
$company_code = $_SESSION["company_code"];
$member_type = $_SESSION["member_type"];
$ip = $_SERVER['REMOTE_ADDR'];

function sanitize_input($input) {
  $input = str_replace(["'", "&", "=", ";"], ["^", "*", "", ""], $input);
  $input = htmlspecialchars($input);
  $input = stripslashes($input);
  return $input;
}

$job_title = sanitize_input($_POST["job_title"]);
$vessel = sanitize_input($_POST["vessel"]);
$job_description1 = sanitize_input($_POST["job_description1"]);
$job_requirement1 = sanitize_input($_POST["job_requirement1"]);
$job_password = sanitize_input($_POST["job_password"]);

$errors = [];

if (empty($job_title) || $job_title == "Choose Below" || $job_title == "-") {
  $errors['job_title'] = "<font color='red'>required!</font>";
}

if (empty($job_password)) {
  $errors['job_password'] = "<font color='red'>required!</font>";
}

if (!empty($errors)) {
  include "../add_job.php";
  exit;
}

$job_password = md5($job_password);

if ($job_password !== $employer_password) {
  $link = "../add_job.php";
  $message = "<font color='red'>Failed!, incorrect Employer Password!</font>";
  include "../action.php";
  exit;
}

$link = mysqli_connect($dbhost, $dbusername, $dbuserpassword, $dbname) or die("Error " . mysqli_error($link));
$query = "SELECT * FROM jobs WHERE job_title='$job_title' AND company_name='$employer_company' AND id='$employer_id' AND password='$employer_password'";
$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) == 0) {
  $today = date("Y-m-d");
  $query = "INSERT INTO jobs (job_title, vessel, job_description, company_name, requirements, id, password, expiry, date_posted, email, company_code, mark, date_modified) 
        VALUES ('$job_title', '$vessel', '$job_description1', '$employer_company', '$job_requirement1', '$employer_id', '$employer_password', '$expiry_date', '$today', '$employer_email', '$company_code', 'y', '$today')";
  mysqli_query($link, $query) or die("Error " . mysqli_error($link));

  $headers = "From: PinoySeaman <noreply@pinoyseaman.com>\r\nMIME-Version: 1.0\r\nContent-type: text/html; charset=iso-8859-1\r\n";
  $email_message = "<font size='2' face='verdana'>
            New Job Posted at PinoySeaman.com<br>
            Job: $job_title<br>
            Posted by: $employer_company<br>
            Date Posted: $today<br><br>
            </font>";
  mail("admin@pinoyseaman.com", "New Job Posted at PinoySeaman", $email_message, $headers);

  $timenow = date("H:i:s");
  $query = "INSERT INTO action (company, date, action, ip, time) VALUES ('$company_code', '$today', 'Job Posted - $job_title', '$ip', '$timenow')";
  mysqli_query($link, $query) or die("Error " . mysqli_error($link));

  $link = "../employer_panel.php";
  $message = "<font color='blue'>Your job ($job_title) has been posted...</font>";
  include "../action.php";
  exit;
} else {
  $link = "../employer_panel.php";
  $message = "<font color='red'>error!, $job_title already posted!</font>";
  include "../action.php";
  exit;
}
?>
