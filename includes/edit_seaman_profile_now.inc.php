<?php
session_start();
include "dbh.inc.php";

if (!isset($_SESSION["seeker_id"]) || !isset($_SESSION["seeker_pass"])) {
    header("location: seaman_login.php");
    exit;
}

$id = $_SESSION["seeker_id"];
$pass = $_SESSION["seeker_pass"];

$link = mysqli_connect($dbhost, $dbusername, $dbuserpassword, $dbname) or die("Error " . mysqli_error($link));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cellphone = mysqli_real_escape_string($link, $_POST['cellphone']);
    $month = mysqli_real_escape_string($link, $_POST['month']);
    $day = mysqli_real_escape_string($link, $_POST['day']);
    $year = mysqli_real_escape_string($link, $_POST['year']);
    $birthday = $year . '-' . $month . '-' . $day;
    $gender = mysqli_real_escape_string($link, $_POST['sex']);
    $city = mysqli_real_escape_string($link, $_POST['city']);
    $seagoing_work = mysqli_real_escape_string($link, $_POST['seagoing_work']);
    $passport_country = mysqli_real_escape_string($link, $_POST['passport_country']);
    $passport_no = mysqli_real_escape_string($link, $_POST['passport_no']);
    $passport_issued = mysqli_real_escape_string($link, $_POST['passport_issued']);
    $passport_valid = mysqli_real_escape_string($link, $_POST['passport_valid']);
    $sbook_country = mysqli_real_escape_string($link, $_POST['sbook_country']);
    $sbook_no = mysqli_real_escape_string($link, $_POST['sbook_no']);
    $sbook_issued = mysqli_real_escape_string($link, $_POST['sbook_issued']);
    $sbook_valid = mysqli_real_escape_string($link, $_POST['sbook_valid']);
    $competence = mysqli_real_escape_string($link, $_POST['competence']);
    $certificates = mysqli_real_escape_string($link, $_POST['certificates']);
    $educ_training = mysqli_real_escape_string($link, $_POST['educ_training']);
    $non_seagoing_work = mysqli_real_escape_string($link, $_POST['non_seagoing_work']);
    $merits = mysqli_real_escape_string($link, $_POST['merits']);
    $allow = mysqli_real_escape_string($link, $_POST['allow']);
    $current_password = mysqli_real_escape_string($link, $_POST['passwrd']);
    $encrypted_password = md5($current_password);

    $query = "SELECT password FROM job_seeker WHERE email = '$id'";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row['password'] != $encrypted_password) {
        echo "Current password is incorrect.";
        exit;
    }

    $update_query = "UPDATE job_seeker SET 
        cellphone = '$cellphone',
        birthday = '$birthday',
        gender = '$gender',
        city = '$city',
        seagoing_work = '$seagoing_work',
        passport_country = '$passport_country',
        passport_no = '$passport_no',
        passport_issued = '$passport_issued',
        passport_valid = '$passport_valid',
        sbook_country = '$sbook_country',
        sbook_no = '$sbook_no',
        sbook_issued = '$sbook_issued',
        sbook_valid = '$sbook_valid',
        competence = '$competence',
        certificates = '$certificates',
        educ_training = '$educ_training',
        non_seagoing_work = '$non_seagoing_work',
        merits = '$merits',
        view = '$allow'
        WHERE email = '$id' AND password = '$encrypted_password'";

    if (mysqli_query($link, $update_query)) {
        echo "Profile updated successfully.";
    } else {
        echo "Error updating profile: " . mysqli_error($link);
    }

    mysqli_close($link);
}
?>