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

$new_email = mysqli_real_escape_string($linksql, $_POST['new_email']);
$new_email2 = mysqli_real_escape_string($linksql, $_POST['new_email2']);
$password = mysqli_real_escape_string($linksql, $_POST['passwrd']);

if ($new_email != $new_email2) {
    echo "<script>alert('Email addresses do not match.'); 
    window.location.href='edit_seaman_email.php';</script>";
    exit;
}

$query = "SELECT * FROM job_seeker WHERE email='$id' AND id='$password'";
$result = mysqli_query($linksql, $query);

if (mysqli_num_rows($result) == 1) {
    $update_query = "UPDATE job_seeker SET email='$new_email' WHERE email='$id'";
    if (mysqli_query($linksql, $update_query)) {
        $_SESSION["seeker_id"] = $new_email;
        $message = "<font color=blue>Email address updated successfully.</font>";
        $link = "seaman_panel.php"; 
        include "./action.php";
        mysqli_close($link);
        mysqli_free_result($result);
        exit;
    } else {
        echo "<script>alert('Error updating email address: " . mysqli_error($linksql) . "'); 
        window.location.href='edit_seaman_email.php';</script>";
    }
} else {
    echo "<script>alert('Invalid password.'); 
    window.location.href='edit_seaman_email.php';</script>";
}

mysqli_close($linksql);

?>

