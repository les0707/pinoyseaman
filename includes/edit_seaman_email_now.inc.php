<?php
session_start();
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

$new_email = htmlspecialchars($_POST['new_email']);
$new_email2 = htmlspecialchars($_POST['new_email2']);
$password = htmlspecialchars($_POST['passwrd']);
$encrypted_password = md5($password);

if ($new_email != $new_email2) {
    echo "<script>alert('Email addresses do not match.'); 
    window.location.href='../edit_seaman_email.php';</script>";
    exit;
}

try {
    // Check if the new email already exists
    $check_query = "SELECT * FROM job_seeker WHERE email = :new_email";
    $stmt = $pdo->prepare($check_query);
    $stmt->bindParam(':new_email', $new_email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $message = "<font color=red>The new email address is already in use.</font>";
        $link = "../edit_seaman_email.php"; 
        include "../action.php";
        exit;
    }

    $query = "SELECT * FROM job_seeker WHERE email = :email AND password = :password";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $id);
    $stmt->bindParam(':password', $encrypted_password);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $update_query = "UPDATE job_seeker SET email = :new_email WHERE email = :email";
        $stmt = $pdo->prepare($update_query);
        $stmt->bindParam(':new_email', $new_email);
        $stmt->bindParam(':email', $id);

        if ($stmt->execute()) {
            $_SESSION["seeker_id"] = $new_email;
            
            // Log the action
            $action_query = "INSERT INTO action (seaman, date, action, time) VALUES (:seaman, NOW(), 'Update Seaman Email', NOW())";
            $action_stmt = $pdo->prepare($action_query);
            $action_stmt->bindParam(':seaman', $id);
            $action_stmt->execute();

            $message = "<font color=blue>Email address updated successfully.</font>";
            $link = "../seaman_profile.php"; 
            include "../action.php";
            exit;
        } else {
            echo "<script>alert('Error updating email address.'); 
            window.location.href='../edit_seaman_email.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid password.'); 
        window.location.href='../edit_seaman_email.php';</script>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>