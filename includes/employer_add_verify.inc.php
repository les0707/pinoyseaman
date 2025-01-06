<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $company_name = trim($_POST["company_name"]);
    $company_profile = trim($_POST["company_profile"]);
    $company_address = trim($_POST["company_address"]);
    $phone = trim($_POST["phone"]);
    $email = trim($_POST["email"]);
    $email2 = trim($_POST["email2"]);
    $contact = trim($_POST["contact"]);
    $website = trim($_POST["website"]);
    $password1 = trim($_POST["password1"]);
    $currentDate = date("Y-m-d");
    $newpassword = md5($password1); // Hash password with md5

    // Function to generate ID
    function generateID($plength)
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTHSNDGYCUCYDHDKEMDJDHKBSHSGRJDHDGDGD';
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

    // Generate new ID 
    $newid = generateID(8);

    try {
        require_once "dbh.inc.php";

        // Check for duplicate entries
        $checkQuery = "SELECT COUNT(*) FROM employer WHERE company = ?";
        $checkStmt = $pdo->prepare($checkQuery);
        $checkStmt->execute([$company_name]);

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
        $query = "INSERT INTO employer (company, company_profile, address, phone, email, email2, contact, website, password, id)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

        $stmt = $pdo->prepare($query);

        $stmt->execute([$company_name, $company_profile, $company_address, $phone, $email, $email2, $contact, $website, $newpassword, $newid]);

        $pdo = null;
        $stmt = null;        

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
?>
