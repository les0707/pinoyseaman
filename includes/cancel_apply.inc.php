<?php
session_start();
include "dbh.inc.php";

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if (!isset($_SESSION["seeker_id"])) {
    header("location: seaman_login.php");
    exit;
}

if (!isset($_SESSION["seeker_pass"])) {
    header("location: seaman_login.php");
    exit;
}

$id = $_SESSION["seeker_id"];
$pass = $_SESSION["seeker_pass"];

$cancel_code = htmlspecialchars($_GET["cancel_code"]);
$cancel_code = str_replace("'", "", $cancel_code);
$cancel_code = stripslashes($cancel_code);
$cancel_code = str_replace(" ", "", $cancel_code);

try {
    // Verify the application exists
    $query = "SELECT * FROM job_applicants WHERE company_code = :cancel_code AND email = :email AND password = :password";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':cancel_code', $cancel_code);
    $stmt->bindValue(':email', $id);
    $stmt->bindValue(':password', $pass);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        $message = "<font color=red>Application not found or you do not have permission to cancel this application.</font>";
        $link = "../applied_history.php";
        include "../action.php";
        exit;
    }

    // Delete the application
    $query = "DELETE FROM job_applicants WHERE company_code = :cancel_code AND email = :email AND password = :password";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':cancel_code', $cancel_code);
    $stmt->bindValue(':email', $id);
    $stmt->bindValue(':password', $pass);
    $stmt->execute();

    $message = "<font color=blue>Your application was successfully canceled.</font>";
    $link = "../seaman_panel.php";
    include "../action.php";
    exit;

} catch (PDOException $e) {
    $message = "Error: " . $e->getMessage();
    $link = "../applied_history.php";
    include "../action.php";
    exit;
}
?>