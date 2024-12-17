<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prefer_job = trim($_POST["prefer_job"]);
    $first_name = trim($_POST["first_name"]);
    $middle_name = trim($_POST["middle_name"]);
    $last_name = trim($_POST["last_name"]);
    $date = trim($_POST["date"]);
    $sex = trim($_POST["sex"]);
    $email = trim($_POST["email"]);
    $cellphone = trim($_POST["cellphone"]);
    $city = trim($_POST["city"]);
    $email2 = trim($_POST["email2"]);
    $passport_country = trim($_POST["passport_country"]);
    $passport_no = trim($_POST["passport_no"]);
    $passport_issued = trim($_POST["passport_issued"]);
    $passport_valid = trim($_POST["passport_valid"]);
    $sbook_country = trim($_POST["sbook_country"]);
    $sbook_no = trim($_POST["sbook_no"]);
    $sbook_issued = trim($_POST["sbook_issued"]);
    $sbook_valid = trim($_POST["sbook_valid"]);
    $seagoing_work = trim($_POST["seagoing_work"]);
    $non_seagoing_work = trim($_POST["non_seagoing_work"]);
    $educ_training = trim($_POST["educ_training"]);
    $merits = trim($_POST["merits"]);
    $currentDate = date("Y-m-d");

    // Normalize first, last, and middle names
    $first_name = ucwords(strtolower($first_name)); 
    $last_name = ucwords(strtolower($last_name));

    if (strtolower($middle_name) !== "n/a") {
        $middle_name = ucwords(strtolower($middle_name));
    } else {
        $middle_name = "n/a";
    }

    // Format birthday
    if (!empty($date)) {
        $date = date("F d, Y", strtotime($date)); // Converts to "Month 00, 0000"
    } else {
        $date = null;
    }

    // Function to generate ID
    function generateID($plength)
    {
        $chars = 'A12BCDEFG4H389JKLMNP567QRSTUVWXYZ';
        mt_srand(microtime(true) * 1000000);
        $pwd = '';

        for ($i = 0; $i < $plength; $i++) {
            $key = mt_rand(0, strlen($chars) - 1);
            $pwd .= $chars[$key];
        }

        // Shuffle characters randomly
        for ($i = 0; $i < $plength; $i++) {
            $key1 = mt_rand(0, strlen($pwd) - 1);
            $key2 = mt_rand(0, strlen($pwd) - 1);
            $tmp = $pwd[$key1];
            $pwd[$key1] = $pwd[$key2];
            $pwd[$key2] = $tmp;
        }

        return $pwd;
    }

    // Generate new ID and password
    $newid = generateID(8);
    $newpassword = md5($newid); // Hash password with md5

    try {
        require_once "dbh.inc.php";

        // Check for duplicate entries
        $checkQuery = "SELECT COUNT(*) FROM job_seeker WHERE first_name = ? AND middle_name = ? AND last_name = ? AND cellphone = ?";
        $checkStmt = $pdo->prepare($checkQuery);
        $checkStmt->execute([$first_name, $middle_name, $last_name, $cellphone]);

        $recordExists = $checkStmt->fetchColumn();

        if ($recordExists > 0) {
            // Duplicate record found
            echo json_encode([
                "success" => false,
                "message" => "Duplicate entry detected: You have already submitted this form."
            ]);
            exit;
        }

        // If no duplicate, proceed with the INSERT
        $query = "INSERT INTO job_seeker (prefer_job, first_name, middle_name, last_name, birthday, gender, email, cellphone, city, passport_country, passport_no, passport_issued, 
                passport_valid, sbook_country, sbook_no, sbook_issued, sbook_valid, seagoing_work, non_seagoing_work, educ_training,
                merits, id, password, date, view, verification)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

        $stmt = $pdo->prepare($query);

        $stmt->execute([$prefer_job, $first_name, $middle_name, $last_name, $date, $sex, $email, $cellphone, $city, $passport_country, $passport_no, $passport_issued,
                        $passport_valid, $sbook_country, $sbook_no, $sbook_issued, $sbook_valid, $seagoing_work, $non_seagoing_work, $educ_training,
                        $merits, $newid, $newpassword, $currentDate, 'y', 'y']);

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