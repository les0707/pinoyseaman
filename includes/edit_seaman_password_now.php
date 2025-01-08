<?php
session_start();
include "dbh.inc.php";

$linksql = mysqli_connect($dbhost, $dbusername, $dbuserpassword, $dbname) or die("Error " . mysqli_error($linksql));

if (!isset($_SESSION["seeker_id"]) || !isset($_SESSION["seeker_pass"])) {
    header("location: seaman_login.php");
    exit;
}

$id = $_SESSION["seeker_id"];
$pass = $_SESSION["seeker_pass"];

$new_password = mysqli_real_escape_string($linksql, $_POST['password']);
$new_password2 = mysqli_real_escape_string($linksql, $_POST['password2']);
$old_password = mysqli_real_escape_string($linksql, $_POST['old_password']);
$encrypted_old_password = md5($old_password);

if ($new_password != $new_password2) {
    $message = "<font color=red>New passwords do not match.</font>";
    $link = "edit_seaman_password.php";
    include "./action.php";
    exit;
}

$query = "SELECT password FROM job_seeker WHERE email='$id'";
$result = mysqli_query($linksql, $query);
$row = mysqli_fetch_assoc($result);

if ($row['password'] != $encrypted_old_password) {
    $message = "<font color=red>Current password is incorrect.</font>";
    $link = "edit_seaman_password.php";
    include "./action.php";
    mysqli_free_result($result);
    mysqli_close($linksql);
    exit;
}

$encrypted_new_password = md5($new_password);
$update_query = "UPDATE job_seeker SET id ='$new_password', password='$encrypted_new_password' WHERE email='$id'";

if (mysqli_query($linksql, $update_query)) {
    $_SESSION["seeker_pass"] = $encrypted_new_password;
    $message = "<font color=blue>Password updated successfully.</font>";
    $link = "seaman_profile.php"; // Redirect to profile page
} else {
    $message = "Error updating password: " . mysqli_error($linksql);
    $link = "edit_seaman_password.php";
}

mysqli_free_result($result);
mysqli_close($linksql);
include "./action.php";
?>