<!-- changed -->

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
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
    $competence = trim($_POST["competence"]);
    $certificates = trim($_POST["certificates"]);
    $currentDate = date("Y-m-d");

    // Normalize names
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

        // Check for duplicate entries by email
        $checkQuery = "SELECT COUNT(*) FROM job_seeker WHERE email = ?";
        $checkStmt = $pdo->prepare($checkQuery);
        $checkStmt->execute([$email]);

        $recordExists = $checkStmt->fetchColumn();

        if ($recordExists > 0) {
            // Duplicate record found
            $link = "../add_seaman.php";
            $message = "<font color='red'>Duplicate entry detected: This email is already registered.</font>";
            include "../action.php";
            exit;
        }

        // If no duplicate, proceed with the INSERT
        $query = "INSERT INTO job_seeker (prefer_job, first_name, middle_name, last_name, birthday, gender, email, cellphone, city, passport_country, passport_no, passport_issued, 
                passport_valid, sbook_country, sbook_no, sbook_issued, sbook_valid, seagoing_work, non_seagoing_work, educ_training,
                merits, id, password, date, view, verification, competence, certificates)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

        $stmt = $pdo->prepare($query);

        $stmt->execute([$prefer_job, $first_name, $middle_name, $last_name, $date, $sex, $email, $cellphone, $city, $passport_country, $passport_no, $passport_issued,
                        $passport_valid, $sbook_country, $sbook_no, $sbook_issued, $sbook_valid, $seagoing_work, $non_seagoing_work, $educ_training,
                        $merits, $newid, $newpassword, $currentDate, 'y', 'y', $competence, $certificates]);

        $pdo = null;
        $stmt = null;

        // Send emails using mail() function
        $to = $email;
        $subject = "From: PinoySeaman <no-reply@pinoyseaman.com>";
        $message = "
            <p>Hello $first_name,</p>
            <p>Welcome to PinoySeaman! Your account has been created successfully.</p>
            <p>Your email: <strong>$email</strong></p>
            <p>Your Auto Generated Password: <strong>$newid</strong></p>
            <p>Please login to your account and update your password to something that you can easily remember.</p>";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <no-reply@pinoyseaman.com>' . "\r\n";

        mail($to, $subject, $message, $headers);

        // Send email to admin
        $to = 'esclanda97@gmail.com';
        $subject = "From: PinoySeaman <no-reply@pinoyseaman.com>";
        $message = "
            <p>A new seaman has registered on PinoySeaman:</p>

            <p>Preferred Job : $prefer_job</p>
            <p>First Name : $first_name</p>
            <p>Middle Name : $middle_name</p>
            <p>Last Name: $last_name</p>
            <p>Birthdate : $date</p>
            <p>Gender : $sex</p>
            <p>City : $city</p>
            <p>Cellphone : $cellphone</p>
            <p> </p>
            <p>Email : $email</p>
            <p>PinoySeaman ID : $newpassword</p>
            <p>Password : $newid</p>
            <p> </p>
            <p>Seagoing Work : $seagoing_work</p>
            <p> </p>
            <p>Passport Country : $passport_country</p>
            <p>Passport Number : $passport_no</p>
            <p>Passport Issued : $passport_issued</p>
            <p>Passport Valid : $passport_valid</p>
            <p> </p>
            <p>Seaman's Book Country : $sbook_country</p>
            <p>Seaman's Book Number : $sbook_no</p>
            <p>Seaman's Book Issued : $sbook_issued</p>
            <p>Seaman's Book Valid : $sbook_valid</p>
            <p> </p>
            <p>Competence : $competence</p>
            <p> </p>
            <p>Certificates : $certificates</p>
            <p> </p>
            <p>Education and Training : $educ_training</p>
            <p> </p>
            <p>Non Seagoing Work : $non_seagoing_work</p>
            <p> </p>
            <p>Merits : $merits</p>";

        mail($to, $subject, $message, $headers);

        // Return success response
        $link = "../add_seaman.php";
        $message = "<font color='green'>Form submitted successfully and emails have been sent.</font>";
        include "../action.php";
        exit;

    } catch (PDOException $e) {
        // Handle query errors
        $link = "../add_seaman.php";
        $message = "<font color='red'>Database error: " . $e->getMessage() . "</font>";
        include "../action.php";
        exit;
    }

} else {
    // Handle invalid request method
    $link = "../add_seaman.php";
    $message = "<font color='red'>Invalid request method.</font>";
    include "../action.php";
    exit;
}
?>
