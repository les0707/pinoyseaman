<?php
include "./connect.php";

$seeker_email = $_POST["seeker_email"];
$seeker_email = str_replace("'", "", $seeker_email); 
$seeker_email = htmlspecialchars($seeker_email);
$seeker_email = stripslashes($seeker_email);
$seeker_email = str_replace("=", "", $seeker_email);
$seeker_email = str_replace(";", "", $seeker_email);

if($seeker_email == "")
{ 
$link = "seaman_help.php";
$message =  "<font color='red'>Email is required!</font>";
include "./action.php";
exit;
}

if (!filter_var($seeker_email, FILTER_VALIDATE_EMAIL)) 
{
$link = "seaman_help.php";
$message =  "<font color='red'>Email is invalid!</font>";
include "./action.php";
exit;
}

/* START -------- disable Birthdate for password recovery -------------------
// month 
$month = $_POST["month"];
$month = stripslashes($month);
$month = str_replace("'", "", $month); 
$month = str_replace('"', "", $month); 
$month = htmlspecialchars($month);

if($month == "-")
{ 
$link = "seaman_help.php";
$message =  "<font color='red'>Birthday (month) is required!</font>";
include "./action.php";
exit;
}

// day
$day = $_POST["day"];
$day = stripslashes($day);
$day = str_replace("'", "", $day); 
$day = str_replace('"', "", $day); 
$day = htmlspecialchars($day);

if($day == "-")
{ 
$link = "seaman_help.php";
$message =  "<font color='red'>Birthday (day) is required!</font>";
include "./action.php";
exit;
}

// year
$year = $_POST["year"];
$year = stripslashes($year);
$year = str_replace("'", "", $year); 
$year = str_replace('"', "", $year); 
$year = htmlspecialchars($year);

if($year == "-")
{ 
$link = "seaman_help.php";
$message =  "<font color='red'>Birthday (year) is required!</font>";
include "./action.php";
exit;
}

$birthday = $month . " " . $day . "," . " " . $year;
-- END ------- disable Birthdate for password recovery ----------------- */


$link = mysqli_connect($dbhost,$dbusername,$dbuserpassword,$dbname) or die("Error " . mysqli_error($link));
//$query = "SELECT * from job_seeker where email = '$seeker_email' and birthday = '$birthday'" or die("Error" . mysqli_error($link));
$query = "SELECT * from job_seeker where email = '$seeker_email'" or die("Error" . mysqli_error($link));
$result = mysqli_query($link, $query);

while($row = mysqli_fetch_array($result)) 
{
$name = $row["first_name"] . " " . $row["last_name"];
$password = $row['id'];


$email_message = 
"Hello $name! \n
You are receiving this email because you (or someone pretending to be you) has requested your password at PinoySeaman.com \n

Email : $seeker_email
Password : $password \n";

$email_message = nl2br($email_message);

$headers = 'From: PinoySeaman.com <info@pinoyseaman.com>' . "\r\n" .
'Reply-To: PinoySeaman.com <info@pinoyseaman.com>' . "\r\n" .
'Bcc: admin@pinoyseaman.com' . "\r\n" .
'MIME-Version: 1.0' . "\r\n" .
'Content-type: text/html; charset=utf-8' . "\r\n" .
'X-Mailer: PHP/' . phpversion();

mail($seeker_email, "PinoySeaman.com password recovery", $email_message, $headers);

/*send email via TurboSMTP
require_once "lib/TurboApiClient.php";

$email = new Email();
$email->setFrom("info@pinoyseaman.com");
$email->setToList($seeker_email);
$email->setCcList("");
$email->setBccList("");	
$email->setSubject("PinoySeaman Password Recovery");
$email->setContent("Content");
$email->setHtmlContent($email_message);
$email->addCustomHeader('X-FirstHeader', "value");
$email->addCustomHeader('X-SecondHeader', "value");
$email->addCustomHeader('X-Header-da-rimuovere', 'value');
$email->removeCustomHeader('X-Header-da-rimuovere');

$turboApiClient = new TurboApiClient("admin@pinoyseaman.com", "LjKm8R#bW");
$response = $turboApiClient->sendEmail($email);
var_dump($response);
*/

$link = "seaman_help.php";
$message =  "<font color=blue>Please check your email ( $seeker_email ), and spam folder, for your login password.</font>";
include "./action.php"; 
exit;
}

$link = "seaman_help.php";
$message =  "<font color='red'>Invalid data!, please verify that your email is correct!</font>";
include "./action.php"; 
exit;	
?>
