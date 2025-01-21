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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cellphone = htmlspecialchars($_POST['cellphone']);
    $birthday = htmlspecialchars($_POST['birthday']);
    $gender = htmlspecialchars($_POST['gender']);
    $city = htmlspecialchars($_POST['city']);
    $seagoing_work = htmlspecialchars($_POST['seagoing_work']);
    $passport_country = htmlspecialchars($_POST['passport_country']);
    $passport_no = htmlspecialchars($_POST['passport_no']);
    $passport_issued = htmlspecialchars($_POST['passport_issued']);
    $passport_valid = htmlspecialchars($_POST['passport_valid']);
    $sbook_country = htmlspecialchars($_POST['sbook_country']);
    $sbook_no = htmlspecialchars($_POST['sbook_no']);
    $sbook_issued = htmlspecialchars($_POST['sbook_issued']);
    $sbook_valid = htmlspecialchars($_POST['sbook_valid']);
    $competence = htmlspecialchars($_POST['competence']);
    $certificates = htmlspecialchars($_POST['certificates']);
    $educ_training = htmlspecialchars($_POST['educ_training']);
    $non_seagoing_work = htmlspecialchars($_POST['non_seagoing_work']);
    $merits = htmlspecialchars($_POST['merits']);
    $view = htmlspecialchars($_POST['view']);
    $current_password = htmlspecialchars($_POST['passwrd']);
    $encrypted_password = md5($current_password);

    try {
        $query = "SELECT password FROM job_seeker WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['password'] != $encrypted_password) {
            echo "Current password is incorrect.";
            exit;
        }

        $update_query = "UPDATE job_seeker SET 
            cellphone = :cellphone,
            birthday = :birthday,
            gender = :gender,
            city = :city,
            seagoing_work = :seagoing_work,
            passport_country = :passport_country,
            passport_no = :passport_no,
            passport_issued = :passport_issued,
            passport_valid = :passport_valid,
            sbook_country = :sbook_country,
            sbook_no = :sbook_no,
            sbook_issued = :sbook_issued,
            sbook_valid = :sbook_valid,
            competence = :competence,
            certificates = :certificates,
            educ_training = :educ_training,
            non_seagoing_work = :non_seagoing_work,
            merits = :merits,
            view = :view
            WHERE email = :email AND password = :password";

        $stmt = $pdo->prepare($update_query);
        $stmt->bindParam(':cellphone', $cellphone);
        $stmt->bindParam(':birthday', $birthday);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':seagoing_work', $seagoing_work);
        $stmt->bindParam(':passport_country', $passport_country);
        $stmt->bindParam(':passport_no', $passport_no);
        $stmt->bindParam(':passport_issued', $passport_issued);
        $stmt->bindParam(':passport_valid', $passport_valid);
        $stmt->bindParam(':sbook_country', $sbook_country);
        $stmt->bindParam(':sbook_no', $sbook_no);
        $stmt->bindParam(':sbook_issued', $sbook_issued);
        $stmt->bindParam(':sbook_valid', $sbook_valid);
        $stmt->bindParam(':competence', $competence);
        $stmt->bindParam(':certificates', $certificates);
        $stmt->bindParam(':educ_training', $educ_training);
        $stmt->bindParam(':non_seagoing_work', $non_seagoing_work);
        $stmt->bindParam(':merits', $merits);
        $stmt->bindParam(':view', $view);
        $stmt->bindParam(':email', $id);
        $stmt->bindParam(':password', $encrypted_password);

        if ($stmt->execute()) {
            // Log the action
            $action_query = "INSERT INTO action (seaman, date, action, time) VALUES (:seaman, NOW(), 'Update Seaman Profile', NOW())";
            $action_stmt = $pdo->prepare($action_query);
            $action_stmt->bindParam(':seaman', $id);
            $action_stmt->execute();

            $message = "<font color=blue>Profile updated successfully.</font>";
            $link = "../edit_seaman_profile.php"; 
            include "../action.php";
            exit;
        } else {
            echo "Error updating profile.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>