<?
session_start();

//error_reporting(E_ALL);
error_reporting(E_STRICT);

date_default_timezone_set('Asia/Manila');
require_once('class.phpmailer.php');
$mail             = new PHPMailer();



function yearsOld($birthday)
{
    if (($birthday = strtotime($birthday)) === false)
    {
        return false;
    }
    for ($i = 0; strtotime("-$i year") > $birthday; ++$i);
    return $i - 1;
}  

$code = @$_POST["code"];
$code = @str_replace("'", "", $code); 
$code = @htmlspecialchars($code);
$code = @stripslashes($code);
$code = @str_replace("=", "", $code);
$code = @str_replace(";", "", $code);

$company_code = @$_POST["company_code"];
$company_code = @str_replace("'", "", $company_code); 
$company_code = @htmlspecialchars($company_code);
$company_code = @stripslashes($company_code);
$company_code = @str_replace("=", "", $company_code);
$company_code = @str_replace(";", "", $company_code);


$job_seeker_id = @$_POST["job_seeker_id"];
$job_seeker_id = @str_replace("'", "", $job_seeker_id); 
$job_seeker_id = @htmlspecialchars($job_seeker_id);
$job_seeker_id = @stripslashes($job_seeker_id);
$job_seeker_id = @str_replace("=", "", $job_seeker_id);
$job_seeker_id = @str_replace(";", "", $job_seeker_id);

if($job_seeker_id == "")
{ 
$job_seeker_id_error = "Required!";
$sw = 1;
}

$job_seeker_password = @$_POST["job_seeker_password"];
$job_seeker_password = @str_replace("'", "", $job_seeker_password); 
$job_seeker_password = @htmlspecialchars($job_seeker_password);
$job_seeker_password = @stripslashes($job_seeker_password);
$job_seeker_password = @str_replace("=", "", $job_seeker_password);
$job_seeker_password = @str_replace(";", "", $job_seeker_password);

if($job_seeker_password == "")
{ 
$job_seeker_password_error = "Required!";
$sw = 1;
}


$job_seeker_password = @md5($job_seeker_password); 

if ($sw == 1)
{
$link = "display_company2.php?code=$code&company_code=$company_code";
$message =  "<font color='red'>Login account required...</font>";
include "./action.php"; 


unset($code);
unset($company_code);
unset($job_seeker_id);
unset($job_seeker_password);
unset($link);
unset($message);
unset($sw);
unset($i);
exit;
}

include "./connect.php";  
$connect = mysql_pconnect($dbhost,$dbusername,$dbuserpassword);
$query = "SELECT * FROM job_seeker WHERE email='$job_seeker_id' AND password='$job_seeker_password'";
$result = @mysql_db_query($dbname,$query);
while($row = @mysql_fetch_array($result))
{
 $registered = $row["date"];
 $name = $row["first_name"] . " " . $row["middle_name"] .  " " . $row["last_name"];
 $first_name = $row["first_name"];
 $middle_name = $row["middle_name"];
 $last_name = $row["last_name"];
 $birthday = $row["birthday"];
 $age = yearsOld($birthday); 
 $gender = $row["gender"];
 $nationality = $row["nationality"];
 $status = $row["status"];
 $children = $row["children"];
 $religion = $row["religion"];
 $homeaddress = $row["address"];
 $city = $row["city"];
 $contact = $row["phone"];
 $cellphone = $row["cellphone"];
 $email = $row["email"];
 $language = $row["language"];
 $passport_country = $row["passport_country"];
 $passport_no = $row["passport_no"];
 $passport_issued = $row["passport_issued"];
 $passport_valid = $row["passport_valid"];
 $sbook_country = $row["sbook_country"];
 $sbook_no = $row["sbook_no"];
 $sbook_issued = $row["sbook_issued"];
 $sbook_valid = $row["sbook_valid"];
 $competence = $row["competence"];
 $certificates = $row["certificates"];
 $merits = $row["merits"];
 $educ_training = $row["educ_training"];
 $seagoing_work = $row["seagoing_work"];
 $non_seagoing_work = $row["non_seagoing_work"];
 $job_prefer = $row["prefer_job"];

// to get the email and company name
$query2 = "SELECT * from employer where company_code='$company_code'";
$result2 = mysql_db_query($dbname,$query2);
while($row2 = @mysql_fetch_array($result2))
	{
	$notifyemail = $row2["email"];
	$company = $row2["company"];
	}

$result3 = mysql_db_query($dbname,"SELECT * FROM job_applicants WHERE job_hiring='$code' and email='$job_seeker_id' and company_code='$company_code'");
$row3 = mysql_fetch_array($result3); 
if($row3 == 0)
{
$query4 = "INSERT INTO job_applicants (company_code,job_hiring,email,password,date,name,company,time) values('$company_code','$code','$job_seeker_id','$job_seeker_password','$datenow','$name','$company','$timenow')";
$result4 = @mysql_query($query4);

// write action
$query5 = "insert into action (seaman,date,action,company,time) values('$job_seeker_id','$datenow','Job application - $code','$company','$timenow')";
$result5 = @mysql_query($query5);


$headers = 'From: PinoySeaman <dyowel@pinoyseaman.com>' . "\r\n" .
'Reply-To: PinoySeaman <dyowel@pinoyseaman.com>' . "\r\n" .
'MIME-Version: 1.0' . "\r\n" .
'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
'X-Mailer: PHP/' . phpversion();

$email_message = "
<font face = 'verdana' size = '2'>
Good Day!
Someone applied for the position of <strong>$code</strong> posted at PinoySeaman.com

Date Registered : $registered
Last Name :  $last_name
First Name : $first_name
Middle Name : $middle_name
Birthday : $birthday
Age  :  $age
Gender : $gender
Nationality : $nationality
Status : $status
Email : $email
Contact No. : $cellphone  / $contact
No. of Children : $children
Religion : $religion
Address : $homeaddress
City : $city
Language or Dialects Spoken : $language

Passport Information :
-------------------------------------------------------
Passport Country : $passport_country
Passport No. $passport_no
Passport Issued : $passport_issued
Passport Valid : $passport_valid

Seamans Book Information :
-------------------------------------------------------
Country : $sbook_country
No. $sbook_no
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
$non_seagoing_work
<br />

*******************************************************************
- this is a system generated email please do not reply
*******************************************************************
";





if ($notifyemail == "recruitment.manila@osm.no")
{
$message =  "<font color='blue'>Application successful! <br/>Your  resume is forwarded to $company.</font>";
include "./action4.php"; 

unset($notifyemail);
unset($code);
unset($company_code);
unset($job_seeker_id);
unset($job_seeker_password);
unset($link);
unset($message);
unset($sw);
unset($registered);
unset($name);
unset($first_name);
unset($middle_name);
unset($last_name);
unset($birthday);
unset($age);
unset($gender);
unset($nationality);
unset($status);
unset($email);
unset($cellphone);
unset($contact);
unset($children);
unset($religion);
unset($homeaddress);
unset($city);
unset($language);
unset($passport_country);
unset($passport_no);
unset($passport_issued);
unset($passport_valid);
unset($sbook_country);
unset($sbook_no);
unset($sbook_issued);
unset($sbook_valid);
unset($merits);
unset($competence);
unset($educ_training);
unset($seagoing_work);
unset($non_seagoing_work);
unset($certificates);
unset($row2);
unset($row3);
mysql_free_result($result);
mysql_free_result($result2);
mysql_free_result($result3);
unset($result4);
unset($result5);
mysql_close($connect);
exit;
}



// PTC,agile,diamondh,pinoyseaman,aboitiz,arctic,bahia,bibby,bluemanila,bw shipping,univan,wagenbog,pacific ocean manning,maersk,german marine, delfi,marlow,scanmar,marlow,nykfil,sealanes,spliethoff,navia,iotc, trans-global
if ($company_code == "7QwDCY3X" || $company_code == "0phradKp" || $company_code == "14fEJ9ix" || $company_code == "0jeC3bhI" || $company_code == "k7nXxJcS" ||  $company_code == "qoEFb109" || $company_code == "0oOHHhor" || $company_code == "0lUIwb4h" || $company_code == "1bUMpO9U" || $company_code == "VGteNsdD" || $company_code == "qUkRP5K8" || $company_code == "pUoElrhS" || $company_code == "0o69DIHt" || $company_code == "yZF95rV7" || $company_code == "Eyt0KW7M"  || $company_code == "ryyAuKmv" || $company_code == "0HWhilKG" || $company_code == "0YMoJW9X" || $company_code == "0HWhilKG"  || $company_code == "nKFJST95" || $company_code == "0XoWWyme" || $company_code == "SJOOUh8L" || $company_code == "h0qaGDAa" || $company_code == "0D9rFJRw")    
{

$body = nl2br($email_message);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "pro.turbo-smtp.com"; // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "pro.turbo-smtp.com"; // sets the SMTP server
$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
$mail->Username   = "admin@pinoyseaman.com"; // SMTP account username
$mail->Password   = "S2MIMTzH";        // SMTP account password

$mail->SetFrom('noreply@pinoyseaman.com', 'PinoySeaman');

$mail->AddReplyTo("noreply@pinoyseaman.com","Do Not Reply");

$mail->Subject    = "Applicant - $code - $last_name, $first_name";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$address = $notifyemail;


$mail->AddAddress($address,"");


if(!$mail->Send()) {

 
  echo "Mailer Error: " . $mail->ErrorInfo;
  
  exit;
} else {

$message =  "<font color='blue'>Application successful! <br/>Your  resume is forwarded to $company.</font>";
include "./action4.php"; 

unset($notifyemail);
unset($company);
unset($headers);
unset($email_message);
unset($code);
unset($company_code);
unset($job_seeker_id);
unset($job_seeker_password);
unset($link);
unset($message);
unset($sw);
unset($registered);
unset($name);
unset($first_name);
unset($middle_name);
unset($last_name);
unset($birthday);
unset($age);
unset($gender);
unset($nationality);
unset($status);
unset($email);
unset($cellphone);
unset($contact);
unset($children);
unset($religion);
unset($homeaddress);
unset($city);
unset($language);
unset($passport_country);
unset($passport_no);
unset($passport_issued);
unset($passport_valid);
unset($sbook_country);
unset($sbook_no);
unset($sbook_issued);
unset($sbook_valid);
unset($merits);
unset($competence);
unset($educ_training);
unset($seagoing_work);
unset($non_seagoing_work);
unset($certificates);
unset($row2);
unset($row3);
mysql_free_result($result);
mysql_free_result($result2);
mysql_free_result($result3);
unset($result4);
unset($result5);
mysql_close($connect);
exit;
}


$message =  "<font color='blue'>You already applied for the position of <strong>$code</strong> at <strong>$company</strong>";
include "./action4.php"; 

unset($notifyemail);
unset($company);
unset($headers);
unset($email_message);
unset($code);
unset($company_code);
unset($job_seeker_id);
unset($job_seeker_password);
unset($link);
unset($message);
unset($sw);
unset($registered);
unset($name);
unset($first_name);
unset($middle_name);
unset($last_name);
unset($birthday);
unset($age);
unset($gender);
unset($nationality);
unset($status);
unset($email);
unset($cellphone);
unset($contact);
unset($children);
unset($religion);
unset($homeaddress);
unset($city);
unset($language);
unset($passport_country);
unset($passport_no);
unset($passport_issued);
unset($passport_valid);
unset($sbook_country);
unset($sbook_no);
unset($sbook_issued);
unset($sbook_valid);
unset($merits);
unset($competence);
unset($educ_training);
unset($seagoing_work);
unset($non_seagoing_work);
unset($certificates);
unset($row2);
unset($row3);
mysql_free_result($result);
mysql_free_result($result2);
mysql_free_result($result3);
unset($result4);
unset($result5);
mysql_close($connect);
exit;
}









$email_message = nl2br($email_message);
mail($notifyemail, "Applicant - $code - $last_name, $first_name", $email_message, $headers);


$message =  "<font color='blue'>Application successful! <br/>Your  resume is forwarded to $company.</font>";
include "./action4.php"; 

unset($notifyemail);
unset($company);
unset($headers);
unset($email_message);
unset($code);
unset($company_code);
unset($job_seeker_id);
unset($job_seeker_password);
unset($link);
unset($message);
unset($sw);
unset($registered);
unset($name);
unset($first_name);
unset($middle_name);
unset($last_name);
unset($birthday);
unset($age);
unset($gender);
unset($nationality);
unset($status);
unset($email);
unset($cellphone);
unset($contact);
unset($children);
unset($religion);
unset($address);
unset($city);
unset($language);
unset($passport_country);
unset($passport_no);
unset($passport_issued);
unset($passport_valid);
unset($sbook_country);
unset($sbook_no);
unset($sbook_issued);
unset($sbook_valid);
unset($merits);
unset($competence);
unset($educ_training);
unset($seagoing_work);
unset($non_seagoing_work);
unset($certificates);
unset($row2);
unset($row3);
mysql_free_result($result);
mysql_free_result($result2);
mysql_free_result($result3);
unset($result4);
unset($result5);
mysql_close($connect);
exit;
}

$message =  "<font color='blue'>You already applied for the position of <strong>$code</strong> at <strong>$company</strong>";
include "./action4.php"; 

unset($notifyemail);
unset($company);
unset($headers);
unset($email_message);
unset($code);
unset($company_code);
unset($job_seeker_id);
unset($job_seeker_password);
unset($link);
unset($message);
unset($sw);
unset($registered);
unset($name);
unset($first_name);
unset($middle_name);
unset($last_name);
unset($birthday);
unset($age);
unset($gender);
unset($nationality);
unset($status);
unset($email);
unset($cellphone);
unset($contact);
unset($children);
unset($religion);
unset($address);
unset($city);
unset($language);
unset($passport_country);
unset($passport_no);
unset($passport_issued);
unset($passport_valid);
unset($sbook_country);
unset($sbook_no);
unset($sbook_issued);
unset($sbook_valid);
unset($merits);
unset($competence);
unset($educ_training);
unset($seagoing_work);
unset($non_seagoing_work);
unset($certificates);
unset($row2);
unset($row3);
mysql_free_result($result);
mysql_free_result($result2);
mysql_free_result($result3);
unset($result4);
unset($result5);
mysql_close($connect);
exit;
}
$link = "display_company2.php?code=$code&company_code=$company_code";
$message =  "<font color='red'>Invalid account!, please check your login details...</font>";
include "./action.php"; 

unset($notifyemail);
unset($company);
unset($headers);
unset($email_message);
unset($code);
unset($company_code);
unset($job_seeker_id);
unset($job_seeker_password);
unset($link);
unset($message);
unset($sw);
unset($registered);
unset($name);
unset($first_name);
unset($middle_name);
unset($last_name);
unset($birthday);
unset($age);
unset($gender);
unset($nationality);
unset($status);
unset($email);
unset($cellphone);
unset($contact);
unset($children);
unset($religion);
unset($address);
unset($city);
unset($language);
unset($passport_country);
unset($passport_no);
unset($passport_issued);
unset($passport_valid);
unset($sbook_country);
unset($sbook_no);
unset($sbook_issued);
unset($sbook_valid);
unset($merits);
unset($competence);
unset($educ_training);
unset($seagoing_work);
unset($non_seagoing_work);
unset($certificates);
unset($row2);
unset($row3);
mysql_free_result($result);
mysql_free_result($result2);
mysql_free_result($result3);
unset($result4);
unset($result5);
mysql_close($connect);
exit;
?>