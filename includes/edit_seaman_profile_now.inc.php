<?php
session_start();
include "./connect.php";

if (!isset($_SESSION["seeker_id"]) || !isset($_SESSION["seeker_pass"])) {
    header("location: seaman_login.php");
    exit;
}

$id = $_SESSION["seeker_id"];
$pass = $_SESSION["seeker_pass"];

$linksql = mysqli_connect($dbhost, $dbusername, $dbuserpassword, $dbname) or die("Error " . mysqli_error($linksql));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cellphone = mysqli_real_escape_string($linksql, $_POST['cellphone']);
    $month = mysqli_real_escape_string($linksql, $_POST['month']);
    $day = mysqli_real_escape_string($linksql, $_POST['day']);
    $year = mysqli_real_escape_string($linksql, $_POST['year']);
    $birthday = $year . '-' . $month . '-' . $day;
    $gender = mysqli_real_escape_string($linksql, $_POST['sex']);
    $city = mysqli_real_escape_string($linksql, $_POST['city']);
    $seagoing_work = mysqli_real_escape_string($linksql, $_POST['seagoing_work']);
    $passport_country = mysqli_real_escape_string($linksql, $_POST['passport_country']);
    $passport_no = mysqli_real_escape_string($linksql, $_POST['passport_no']);
    $passport_issued = mysqli_real_escape_string($linksql, $_POST['passport_issued']);
    $passport_valid = mysqli_real_escape_string($linksql, $_POST['passport_valid']);
    $sbook_country = mysqli_real_escape_string($linksql, $_POST['sbook_country']);
    $sbook_no = mysqli_real_escape_string($linksql, $_POST['sbook_no']);
    $sbook_issued = mysqli_real_escape_string($linksql, $_POST['sbook_issued']);
    $sbook_valid = mysqli_real_escape_string($linksql, $_POST['sbook_valid']);
    $competence = mysqli_real_escape_string($linksql, $_POST['competence']);
    $certificates = mysqli_real_escape_string($linksql, $_POST['certificates']);
    $educ_training = mysqli_real_escape_string($linksql, $_POST['educ_training']);
    $non_seagoing_work = mysqli_real_escape_string($linksql, $_POST['non_seagoing_work']);
    $merits = mysqli_real_escape_string($linksql, $_POST['merits']);
    $allow = mysqli_real_escape_string($linksql, $_POST['allow']);
    $current_password = mysqli_real_escape_string($linksql, $_POST['passwrd']);
    $encrypted_password = md5($current_password);

    $query = "SELECT password FROM job_seeker WHERE email = '$id'";
    $result = mysqli_query($linksql, $query);
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

    if (mysqli_query($linksql, $update_query)) {
        $message = "<font color=blue>Profile updated successfully.</font>";
        $link = "seaman_panel.php"; 
        include "./action.php";
        mysqli_close($link);
        mysqli_free_result($result);
        exit;
    } else {
        echo "Error updating profile: " . mysqli_error($linksql);
    }

    mysqli_close($linksql);
}
?>