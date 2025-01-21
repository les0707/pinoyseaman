<?php
session_start();

$company_email = $_POST["company_email"];
$company_email = str_replace("'", "", $company_email);
$company_email = htmlspecialchars($company_email);
$company_email = stripslashes($company_email);
$company_email = str_replace("=", "", $company_email);
$company_email = str_replace(";", "", $company_email);


if($company_email == "")
{ 
$link = "employer_help.php";
$message =  "<font color='red'>Email is required!</font>";
include "./action.php";
exit;
}


if (!filter_var($company_email, FILTER_VALIDATE_EMAIL)) {
$link = "employer_help.php";
$message =  "<font color='red'>Email is invalid!</font>";
include "./action.php";
exit;
}


include "./connect.php";
$link = mysqli_connect($dbhost,$dbusername,$dbuserpassword,$dbname) or die("Error " . mysqli_error($link));
$query = "SELECT id,company,post,secret,email FROM employer WHERE email LIKE '%$company_email%'" or die("Error" . mysqli_error($link));
$result = mysqli_query($link, $query);

while($row = mysqli_fetch_array($result))
{
 $newid = $row["id"];
 $company = $row["company"];
 $status = $row["post"];
 $secret = $row['secret'];

 if($status <> "y")
  {
  $link = "employer_help.php";
  $message =  "<font color='red'>Your employer account is currently inactive, please contact PinoySeaman for details.</font>";
  include "./action.php";
  exit;
  }
  
  $email_message = "<font face = 'verdana' size = '2'>Hello $company,
  <br /><br />
  You are receiving this email because you have (or someone pretending to be you) has requested for your login account at PinoySeaman.com. If you did not request this email then please ignore it, if you keep receiving email please contact PinoySeaman.
  <br /><br />
  Employer ID : $newid
  <br /> 
  Password : $secret
  </font>
  ";

/*
//dreamcode email

$headers = 'From: PinoySeaman <infopinoyseaman.com>' . "\r\n" .
   'Reply-To: PinoySeaman <infopinoyseaman.com>' . "\r\n" .
   'MIME-Version: 1.0' . "\r\n" .
   'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
   'X-Mailer: PHP/' . phpversion(); 
   
mail($company_email, "PinoySeaman Account Recovery.", $email_message, $headers);

*/


//send email using sendgrid 
$url = 'https://api.sendgrid.com/';
$user = 'pinoyseaman';
$pass = 'AsawaniKathy3';

//$user = 'pinoy_xmtics';
//$pass = 'w3bhack88';

$params = array(
    'api_user'  => $user,
    'api_key'   => $pass,
    'to'        => $company_email,
    'subject'   => 'PinoySeaman Account Recovery..',
    'html'      => $email_message,
    'text'      => $email_message,
    'from'      => 'PinoySeaman <noreply@pinoyseaman.com>',
  );


$request =  $url.'api/mail.send.json';

$session = curl_init($request);
curl_setopt ($session, CURLOPT_POST, true);
curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
curl_setopt($session, CURLOPT_HEADER, false);
curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($session);
curl_close($session);


// TURBOsmtp email
require_once "lib/TurboApiClient.php";
$email = new Email();
$email->setFrom("info@pinoyseaman.com", "PinoySeaman");
$email->setToList($company_email);
$email->setCcList("");
$email->setBccList("");	
$email->setSubject("PinoySeaman Account Recovery...");
$email->setContent("Content");
$email->setHtmlContent($email_message);
$email->addCustomHeader('X-FirstHeader', "value");
$email->addCustomHeader('X-SecondHeader', "value");
$email->addCustomHeader('X-Header-da-rimuovere', 'value');
$email->removeCustomHeader('X-Header-da-rimuovere');

$turboApiClient = new TurboApiClient("admin@pinoyseaman.com", "LjKm8R#bW");
$response = $turboApiClient->sendEmail($email);


$link = "employer_help.php";
$message =  "<font color='blue'>Your login account was forwarded to your email ($company_email)</font>";
include "./action.php"; 
exit;

}
$link = "employer_help.php";
$message =  "<font color='red'>Email address is not registered on our database...</font>";
include "./action.php"; 
exit;
?>