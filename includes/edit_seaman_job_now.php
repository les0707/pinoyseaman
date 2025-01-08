<?php
session_start();
include "./connect.php";

$linksql = mysqli_connect($dbhost, $dbusername, $dbuserpassword, $dbname) or die("Error " . mysqli_error($linksql));

if (!isset($_SESSION["seeker_id"]) || !isset($_SESSION["seeker_pass"])) {
    header("location: seaman_login.php");
    exit;
}

$id = $_SESSION["seeker_id"];
$pass = $_SESSION["seeker_pass"];

$new_job_position = mysqli_real_escape_string($linksql, $_POST['job_prefer2']);
$password = mysqli_real_escape_string($linksql, $_POST['passwrd']);
$encrypted_password = md5($password);

$query = "SELECT password FROM job_seeker WHERE email='$id'";
$result = mysqli_query($linksql, $query);
$row = mysqli_fetch_assoc($result);

if ($row['password'] != $encrypted_password) {
    $message = "<font color=red>Current password is incorrect.</font>";
    $link = "edit_seaman_job.php";
    include "./action.php";
    mysqli_free_result($result);
    mysqli_close($linksql);
    exit;
}

$update_query = "UPDATE job_seeker SET prefer_job='$new_job_position' WHERE email='$id'";

if (mysqli_query($linksql, $update_query)) {
    $message = "<font color=blue>Job position updated successfully.</font>";
    $link = "seaman_profile.php";
} else {
    $message = "Error updating job position: " . mysqli_error($linksql);
    $link = "edit_seaman_job.php";
}

mysqli_free_result($result);
mysqli_close($linksql);
include "./action.php";
?>