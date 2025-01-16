<?php
session_start();
include "dbh.inc.php";

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$job_title = htmlspecialchars($_POST["job_title"]);
$company_code = htmlspecialchars($_POST["company_code"]);
$job_seeker_id = htmlspecialchars($_POST["job_seeker_id"]);
$job_seeker_password = htmlspecialchars($_POST["job_seeker_password"]);

if (empty($job_seeker_id) || empty($job_seeker_password)) {
    $message = "<font color='red'>Login account required...</font>";
    $link = "../display_company2.php";
    include "../action.php";
    exit;
}

$job_seeker_password = md5($job_seeker_password);

try {
    // Get seaman information
    $query = "SELECT * FROM job_seeker WHERE email = :email AND password = :password";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':email', $job_seeker_id);
    $stmt->bindValue(':password', $job_seeker_password);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        $message = "<font color='red'>Invalid account!, please check your login details...</font>";
        $link = "../display_company2.php";
        include "../action.php";
        exit;
    }

    $registered = $row["date"];
    $first_name = $row["first_name"];
    $middle_name = $row["middle_name"];
    $last_name = $row["last_name"];
    $name = $first_name . " " . $middle_name . " " . $last_name;
    $cellphone = $row["cellphone"];
    $seaman_email = $row["email"];
    $language = $row["language"];
    $passport_country = $row["passport_country"];
    $passport_no = $row["passport_no"];
    $passport_issued = $row["passport_issued"];
    $passport_valid = $row["passport_valid"];
    $sbook_country = $row["sbook_country"];
    $sbook_no = $row["sbook_no"];
    $sbook_issued = $row["sbook_issued"];
    $sbook_valid = $row["sbook_valid"];
    $competence = htmlspecialchars($row["competence"]);
    $certificates = htmlspecialchars($row["certificates"]);
    $merits = htmlspecialchars($row["merits"]);
    $educ_training = htmlspecialchars($row["educ_training"]);
    $seagoing_work = htmlspecialchars($row["seagoing_work"]);
    $non_seagoing_work = htmlspecialchars($row["non_seagoing_work"]);
    $job_prefer = $row["prefer_job"];

    // Get company details
    $query2 = "SELECT * FROM employer WHERE company_code = :company_code";
    $stmt2 = $pdo->prepare($query2);
    $stmt2->bindValue(':company_code', $company_code);
    $stmt2->execute();
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

    if (!$row2) {
        $message = "<font color='red'>Invalid company code.</font>";
        $link = "../display_company2.php";
        include "../action.php";
        exit;
    }

    $notifyemail = $row2["email"];
    $notifyemail2 = $row2["email2"];
    $notifyemail3 = $row2["email3"];
    $company = $row2["company"];

    // Check if seaman already applied for the position
    $query3 = "SELECT * FROM job_applicants WHERE job_hiring = :job_title AND email = :email AND company_code = :company_code";
    $stmt3 = $pdo->prepare($query3);
    $stmt3->bindValue(':job_title', $job_title);
    $stmt3->bindValue(':email', $job_seeker_id);
    $stmt3->bindValue(':company_code', $company_code);
    $stmt3->execute();
    $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);

    if ($row3) {
        $message = "<font color='blue'>You already applied for the position of <strong>$job_title</strong> at <strong>$company</strong></font>";
        include "../action4.php";
        exit;
    }

    // Insert job application
    $query4 = "INSERT INTO job_applicants (company_code, job_hiring, email, password, date, name, company, time) VALUES (:company_code, :job_title, :email, :password, :date, :name, :company, :time)";
    $stmt4 = $pdo->prepare($query4);
    $stmt4->bindValue(':company_code', $company_code);
    $stmt4->bindValue(':job_title', $job_title);
    $stmt4->bindValue(':email', $job_seeker_id);
    $stmt4->bindValue(':password', $job_seeker_password);
    $stmt4->bindValue(':date', $datenow);
    $stmt4->bindValue(':name', $name);
    $stmt4->bindValue(':company', $company);
    $stmt4->bindValue(':time', $timenow);
    $stmt4->execute();

    // Write action
    $query5 = "INSERT INTO action (seaman, date, action, company, time) VALUES (:seaman, :date, :action, :company, :time)";
    $stmt5 = $pdo->prepare($query5);
    $stmt5->bindValue(':seaman', $job_seeker_id);
    $stmt5->bindValue(':date', $datenow);
    $stmt5->bindValue(':action', $action = "Job application - $job_title");
    $stmt5->bindValue(':company', $company);
    $stmt5->bindValue(':time', $timenow);
    $stmt5->execute();

    // Send email notification
    $email_message = "
    Good Day!
    Someone applied for the position of $job_title posted at PinoySeaman.

    Note :
    Do not reply on this email, this is an auto generated notification from PinoySeaman website. Please reply to seaman email address  $seaman_email

    Date Registered : $registered
    Last Name :  $last_name
    First Name : $first_name
    Middle Name : $middle_name

    Email : $seaman_email
    Contact No. : $cellphone

    Passport Information :
    -------------------------------------------------------
    Passport Country : $passport_country
    Passport No. $passport_no
    Passport Issued : $passport_issued
    Passport Valid : $passport_valid

    Seamans Book Information :
    -------------------------------------------------------
    Country : $sbook_country
    No. : $sbook_no
    Issued : $sbook_issued
    Valid :  $sbook_valid

    Licences of Competence :
    -------------------------------------------------------
    $competence

    Certificates : 
    -------------------------------------------------------
    $certificates

    Merits, Rewards, Titles, Hobbies, Interests :
    -------------------------------------------------------
    $merits

    Education and Training :
    -------------------------------------------------------
    $educ_training

    Details of your past and present Seagoing Work Experiences
    ( name of vessel - rank - sign on - sign off - manning agency - vessel type - grt - main engine - trading area )
    -------------------------------------------------------
    $seagoing_work

    Details of your Non-Seagoing Work Experiences :
    -------------------------------------------------------
    $non_seagoing_work";

    $email_message = nl2br($email_message);
    $headers = 'From: PinoySeaman <info@pinoyseaman.com>' . "\r\n" .
               'Reply-To: PinoySeaman <admin@pinoyseaman.com>' . "\r\n" .
               'MIME-Version: 1.0' . "\r\n" .
               'Content-type: text/html; charset=utf-8' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    mail($notifyemail, "Applicant - $job_title - $last_name, $first_name", $email_message, $headers);

    if (!empty($notifyemail2)) {
        mail($notifyemail2, "Applicant - $job_title - $last_name, $first_name", $email_message, $headers);
    }

    if (!empty($notifyemail3)) {
        mail($notifyemail3, "Applicant - $job_title - $last_name, $first_name", $email_message, $headers);
    }

    $message = "<font color='blue'>Application successful! <br/>Your resume is forwarded to $company.<br/>They will cordially respond to your application should they find your qualification suitable to their current open position. Thank you!.</font>";
    include "../action4.php";
    exit;

} catch (PDOException $e) {
    $message = "Error: " . $e->getMessage();
    $link = "../display_company2.php";
    include "./action.php";
    exit;
}
?>