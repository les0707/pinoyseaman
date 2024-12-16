<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $last_name = $_POST["last_name"];
    $date = $_POST["date"];
    $sex = $_POST["sex"];
    $email = $_POST["email"];
    $cellphone = $_POST["cellphone"];
    $city = $_POST["city"];
    $email2 = $_POST["email2"];
    $passport_country = $_POST["passport_country"];
    $passport_no = $_POST["passport_no"];
    $passport_issued = $_POST["passport_issued"];
    $passport_valid = $_POST["passport_valid"];
    $sbook_country = $_POST["sbook_country"];
    $sbook_no = $_POST["sbook_no"];
    $sbook_issued = $_POST["sbook_issued"];
    $sbook_valid = $_POST["sbook_valid"];
    $seagoing_work = $_POST["seagoing_work"];
    $non_seagoing_work = $_POST["non_seagoing_work"];
    $educ_training = $_POST["educ_training"];
    $merits = $_POST["merits"];
    // $first_name = $_POST["first_name"];
    // $first_name = $_POST["first_name"];
    // $first_name = $_POST["first_name"];
    // $first_name = $_POST["first_name"];


    try {
        require_once "dbh.inc.php";

        $query = "INSERT INTO job_seeker (first_name, middle_name, last_name, date, gender, email, phone, city, passport_country, passport_no,
                passport_issued, passport_valid, sbook_country, sbook_no, sbook_issued, sbook_valid, seagoing_work, non_seagoing_work, educ_training,
                merits) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

        $stmt = $pdo->prepare($query);

        $stmt->execute([$first_name, $middle_name, $last_name, $date, $sex, $email, $cellphone, $city, $passport_country, $passport_no, $passport_issued,
                        $passport_valid, $sbook_country, $sbook_no, $sbook_issued, $sbook_valid, $seagoing_work, $non_seagoing_work, $educ_training,
                        $merits]);

        $pdo = null;
        $stmt = null;

        // Return success response
        echo json_encode([
            "success" => true,
            "message" => "Form submitted successfully."
        ]);
        exit;

    } catch (PDOException $e) {
        // Handle query errors
        echo json_encode([
            "success" => false,
            "message" => "Database error: " . $e->getMessage()
        ]);
        exit;
    }

} else {
    // Handle invalid request method
    echo json_encode([
        "success" => false,
        "message" => "Invalid request method."
    ]);
    exit;
}