<?php
session_start();
include "dbh.inc.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION["seeker_id"]) || !isset($_SESSION["seeker_pass"])) {
    header("location: seaman_login.php");
    exit;
}

$id = $_SESSION["seeker_id"];
$pass = $_SESSION["seeker_pass"];

$new_job_position = htmlspecialchars($_POST['job_prefer2']);
$password = htmlspecialchars($_POST['passwrd']);
$encrypted_password = md5($password);

try {
    $query = "SELECT password FROM job_seeker WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['password'] != $encrypted_password) {
        $message = "<font color=red>Current password is incorrect.</font>";
        $link = "../edit_seaman_job.php";
        include "../action.php";
        exit;
    }

    $update_query = "UPDATE job_seeker SET prefer_job = :new_job_position WHERE email = :email";
    $stmt = $pdo->prepare($update_query);
    $stmt->bindParam(':new_job_position', $new_job_position);
    $stmt->bindParam(':email', $id);

    if ($stmt->execute()) {
        $message = "<font color=blue>Job position updated successfully.</font>";
        $link = "../seaman_profile.php";
    } else {
        $message = "Error updating job position.";
        $link = "../edit_seaman_job.php";
    }
} catch (PDOException $e) {
    $message = "Error: " . $e->getMessage();
    $link = "../edit_seaman_job.php";
}

include "../action.php";
?>