<?php
session_start();
$ip = $_SERVER['REMOTE_ADDR'];
include "dbh.inc.php";

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if (!isset($_SESSION["seeker_id"]) || !isset($_SESSION["seeker_pass"])) {
    header("location: seaman_login.php");
    exit;
}

$id = $_SESSION["seeker_id"];
$pass = $_SESSION["seeker_pass"];

$new_password = htmlspecialchars($_POST['password']);
$new_password2 = htmlspecialchars($_POST['password2']);
$old_password = htmlspecialchars($_POST['old_password']);
$encrypted_old_password = md5($old_password);

if ($new_password != $new_password2) {
    $message = "<font color=red>New passwords do not match.</font>";
    $link = "../edit_seaman_password.php";
    include "../action.php";
    exit;
}

try {
    $query = "SELECT password FROM job_seeker WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['password'] != $encrypted_old_password) {
        $message = "<font color=red>Current password is incorrect.</font>";
        $link = "../edit_seaman_password.php";
        include "../action.php";
        exit;
    }

    $encrypted_new_password = md5($new_password);
    $update_query = "UPDATE job_seeker SET password = :new_password, id = :new_password2 WHERE email = :email";
    $stmt = $pdo->prepare($update_query);
    $stmt->bindParam(':new_password', $encrypted_new_password);
    $stmt->bindParam(':new_password2', $new_password);
    $stmt->bindParam(':email', $id);

    if ($stmt->execute()) {
        // Log the action with IP address
        $action_query = "INSERT INTO action (seaman, date, action, time, ip) VALUES (:seaman, NOW(), 'Update Seaman Password', NOW(), :ip)";
        $action_stmt = $pdo->prepare($action_query);
        $action_stmt->bindParam(':seaman', $id);
        $action_stmt->bindParam(':ip', $ip);
        $action_stmt->execute();

        $_SESSION["seeker_pass"] = $encrypted_new_password;
        $message = "<font color=blue>Password updated successfully.</font>";
        $link = "../seaman_profile.php";
    } else {
        $message = "Error updating password.";
        $link = "../edit_seaman_password.php";
    }
} catch (PDOException $e) {
    $message = "Error: " . $e->getMessage();
    $link = "../edit_seaman_password.php";
}

include "../action.php";
?>