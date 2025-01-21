<?
include "./connect.php";
$first_name = @$_POST["first_name"];
$first_name = @str_replace("'", "", $first_name);
$first_name = @htmlspecialchars($first_name);
$first_name = @stripslashes($first_name);
$first_name = @str_replace("=", "", $first_name);
$first_name = @str_replace(";", "", $first_name);

$first_name = @strtolower($first_name);
$first_name = @ucwords($first_name);

if($first_name == "")
{ 
$first_name_error = "<font color='red'>Required!</font>";
$sw = 1;
}


if (ereg("Http://",$first_name))
{
include "./add_seaman.php"; 
exit;
}

if (ereg("http://",$first_name))
{
include "./add_seaman.php"; 
exit;
}


$middle_name = @$_POST["middle_name"];
$middle_name = @str_replace("'", "", $middle_name);
$middle_name = @htmlspecialchars($middle_name);
$middle_name = @stripslashes($middle_name);
$middle_name = @str_replace("=", "", $middle_name);
$middle_name = @str_replace(";", "", $middle_name);

$middle_name = @strtolower($middle_name);
$middle_name = @ucwords($middle_name);


if($middle_name == "")
{ 
$middle_name_error = "<font color='red'>Required!</font>";
$sw = 1;
}

if (ereg("Http://",$middle_name))
{
include "./add_seaman.php"; 
exit;
}

if (ereg("http://",$middle_name))
{
include "./add_seaman.php"; 
exit;
}

$last_name = @$_POST["last_name"];
$last_name = @str_replace("'", "", $last_name);
$last_name = @htmlspecialchars($last_name);
$last_name = @stripslashes($last_name);
$last_name = @str_replace("=", "", $last_name);
$last_name = @str_replace(";", "", $last_name);

$last_name = @strtolower($last_name);
$last_name = @ucwords($last_name);

if($last_name == "")
{ 
$last_name_error = "<font color='red'>Required!</font>";
$sw = 1;
}


if (ereg("Http://",$last_name))
{
include "./add_seaman.php"; 
exit;
}

if (ereg("http://",$last_name))
{
include "./add_seaman.php"; 
exit;
}

$month = @$_POST["month"];
$month = @str_replace("'", "", $month);
$month = @htmlspecialchars($month);
$month = @stripslashes($month);
$month = @str_replace("=", "", $month);
$month = @str_replace(";", "", $month);

if($month == "-")
{ 
$date_error = "<font color='red'>Required!</font>";
$sw = 1;
}

if($month == "")
{ 
$date_error = "<font color='red'>Required!</font>";
$sw = 1;
}

$day = @$_POST["day"];
$day = @str_replace("'", "", $day);
$day = @htmlspecialchars($day);
$day = @stripslashes($day);
$day = @str_replace("=", "", $day);
$day = @str_replace(";", "", $day);

if($day == "-")
{ 
$date_error = "<font color='red'>Required!</font>";
$sw = 1;
}

if($day == "")
{ 
$date_error = "<font color='red'>Required!</font>";
$sw = 1;
}

$year = @$_POST["year"];
$year = @str_replace("'", "", $year);
$year = @htmlspecialchars($year);
$year = @stripslashes($year);
$year = @str_replace("=", "", $year);
$year = @str_replace(";", "", $year);

if($year == "-")
{ 
$date_error = "<font color='red'>Required!</font>";
$sw = 1;
}

if($year == "")
{ 
$date_error = "<font color='red'>Required!</font>";
$sw = 1;
}


$sex = @$_POST["sex"];
$sex = @str_replace("'", "", $sex);
$sex = @htmlspecialchars($sex);
$sex = @stripslashes($sex);
$sex = @str_replace("=", "", $sex);
$sex = @str_replace(";", "", $sex);

if($sex == "-")
{ 
$sex_error = "<font color='red'>Required!</font>";
$sw = 1;
}

if($sex == "")
{ 
$sex_error = "<font color='red'>Required!</font>";
$sw = 1;
}

$nationality = @$_POST["nationality"];
$nationality = @str_replace("'", "", $nationality);
$nationality = @htmlspecialchars($nationality);
$nationality = @stripslashes($nationality);
$nationality = @str_replace("=", "", $nationality);
$nationality = @str_replace(";", "", $nationality);

if($nationality == "")
{ 
$nationality_error = "<font color='red'>Required!</font>";
$sw = 1;
}


$status = @$_POST["status"];
$status = @str_replace("'", "", $status);
$status = @htmlspecialchars($status);
$status = @stripslashes($status);
$status = @str_replace("=", "", $status);
$status = @str_replace(";", "", $status);

if($status == "-")
{ 
$marital_error = "<font color='red'>Required!</font>";
$sw = 1;
}

if($status == "")
{ 
$marital_error = "<font color='red'>Required!</font>";
$sw = 1;
}

$children = @$_POST["children"];
$children = @str_replace("'", "", $children);
$children = @htmlspecialchars($children);
$children = @stripslashes($children);
$children = @str_replace("=", "", $children);
$children = @str_replace(";", "", $children);

$religion = @$_POST["religion"];
$religion = @str_replace("'", "", $religion);
$religion = @htmlspecialchars($religion);
$religion = @stripslashes($religion);
$religion = @str_replace("=", "", $religion);
$religion = @str_replace(";", "", $religion);


if($religion == "")
{ 
$religion_error = "<font color='red'>Required!</font>";
$sw = 1;
}

$address = @$_POST["address"];
$address = @str_replace("'", "", $address); 
$address = @htmlspecialchars($address);
$address = @stripslashes($address);
$address = @str_replace("=", "", $address);
$address = @str_replace(";", "", $address);

if($address == "")
{ 
$address_error = "<font color='red'>Required!</font>";
$sw = 1;
}


$city = @$_POST["city"];
$city = @str_replace("'", "", $city); 
$city = @htmlspecialchars($city);
$city = @stripslashes($city);
$city = @str_replace("=", "", $city);
$city = @str_replace(";", "", $city);

$phone = @$_POST["phone"];
$phone = @str_replace(" ", "", $phone); 
$phone = @str_replace("'", "", $phone);
$phone = @htmlspecialchars($phone);
$phone = @stripslashes($phone);
$phone = @str_replace("=", "", $phone);
$phone = @str_replace(";", "", $phone);

$cellphone = @$_POST["cellphone"];
$cellphone = @str_replace("'", "", $cellphone); 
$cellphone = @htmlspecialchars($cellphone);
$cellphone = @stripslashes($cellphone);
$cellphone = @str_replace("=", "", $cellphone);
$cellphone = @str_replace(";", "", $cellphone);

if($cellphone == "")
{ 
$cellphone_error = "<font color='red'>Required!</font>";
$sw = 1;
}

$email = @$_POST["email"];
$email= @str_replace("'", "", $email); 
$email= @htmlspecialchars($email);
$email= @stripslashes($email);
$email= @str_replace("=", "", $email);
$email= @str_replace(";", "", $email);

if($email == "")
{ 
$email_error = "<font color='red'>Required!</font>";
$sw = 1;
}

$email2 = @$_POST["email2"];
$email2 = @str_replace("'", "", $email2); 
$email2 = @htmlspecialchars($email2);
$email2 = @stripslashes($email2);
$email2 = @str_replace("=", "", $email2);
$email2 = @str_replace(";", "", $email2);

if($email2 == "")
{ 
$email2_error = "<font color='red'>Required!</font>";
$sw = 1;
}



if($email != $email2)
{ 
$mali_error = "<font color='red'> Please confirm email address.</font>";
$sw = 1;
}


$language = @$_POST["language"];
$language= @str_replace("'", "", $language);
$language= @htmlspecialchars($language);
$language= @stripslashes($language);
$language= @str_replace("=", "", $language);
$language= @str_replace(";", "", $language);


if($language == "")
{ 
$language_error = "<font color='red'>Required!</font>";
$sw = 1;
}


$prefer_job = @$_POST["prefer_job"];
$prefer_job= @str_replace("'", "", $prefer_job);
$prefer_job= @htmlspecialchars($prefer_job);
$prefer_job= @stripslashes($prefer_job);
$prefer_job= @str_replace("=", "", $prefer_job);
$prefer_job= @str_replace(";", "", $prefer_job);

if($prefer_job == "")
{ 
$prefer_job_error = "<font color='red'>Required!</font>";
$sw = 1;
}

$passport_country = @$_POST["passport_country"];
$passport_country = @str_replace("'", "", $passport_country); 
$passport_country = @htmlspecialchars($passport_country);
$passport_country = @stripslashes($passport_country);
$passport_country = @str_replace("=", "", $passport_country);
$passport_country = @str_replace(";", "", $passport_country);


$passport_no = @$_POST["passport_no"];
$passport_no = @str_replace("'", "", $passport_no); 
$passport_no = @htmlspecialchars($passport_no);
$passport_no = @stripslashes($passport_no);
$passport_no = @str_replace("=", "", $passport_no);
$passport_no = @str_replace(";", "", $passport_no);

$passport_issued = @$_POST["passport_issued"];
$passport_issued = @str_replace("'", "", $passport_issued); 
$passport_issued = @htmlspecialchars($passport_issued);
$passport_issued = @stripslashes($passport_issued);
$passport_issued = @str_replace("=", "", $passport_issued);
$passport_issued = @str_replace(";", "", $passport_issued);

$passport_valid = @$_POST["passport_valid"];
$passport_valid = @str_replace("'", "", $passport_valid); 
$passport_valid = @htmlspecialchars($passport_valid);
$passport_valid = @stripslashes($passport_valid);
$passport_valid = @str_replace("=", "", $passport_valid);
$passport_valid = @str_replace(";", "", $passport_valid);

$sbook_country = @$_POST["sbook_country"];
$sbook_country = @str_replace("'", "", $sbook_country); 
$sbook_country = @htmlspecialchars($sbook_country);
$sbook_country = @stripslashes($sbook_country);
$sbook_country = @str_replace("=", "", $sbook_country);
$sbook_country = @str_replace(";", "", $sbook_country);

$sbook_no = @$_POST["sbook_no"];
$sbook_no = @str_replace("'", "", $sbook_no); 
$sbook_no = @htmlspecialchars($sbook_no);
$sbook_no = @stripslashes($sbook_no);
$sbook_no = @str_replace("=", "", $sbook_no);
$sbook_no = @str_replace(";", "", $sbook_no);

$sbook_issued = @$_POST["sbook_issued"];
$sbook_issued = @str_replace("'", "", $sbook_issued); 
$sbook_issued = @htmlspecialchars($sbook_issued);
$sbook_issued = @stripslashes($sbook_issued);
$sbook_issued = @str_replace("=", "", $sbook_issued);
$sbook_issued = @str_replace(";", "", $sbook_issued);

$sbook_valid = @$_POST["sbook_valid"];
$sbook_valid = @str_replace("'", "", $sbook_valid); 
$sbook_valid = @htmlspecialchars($sbook_valid);
$sbook_valid = @stripslashes($sbook_valid);
$sbook_valid = @str_replace("=", "", $sbook_valid);
$sbook_valid = @str_replace(";", "", $sbook_valid);

$competence = @$_POST["competence"];
$competence= @str_replace("'", "", $competence); 
$competence= @htmlspecialchars($competence);
$competence= @stripslashes($competence);
$competence= @str_replace("=", "", $competence);
$competence= @str_replace(";", "", $competence);

$certificates = @$_POST["certificates"];
$certificates= @str_replace("'", "", $certificates); 
$certificates= @htmlspecialchars($certificates);
$certificates= @stripslashes($certificates);
$certificates= @str_replace("=", "", $certificates);
$certificates= @str_replace(";", "", $certificates);

$merits = @$_POST["merits"];
$merits= @str_replace("'", "", $merits); 
$merits= @htmlspecialchars($merits);
$merits= @stripslashes($merits);
$merits= @str_replace("=", "", $merits);
$merits= @str_replace(";", "", $merits);

$educ_training = @$_POST["educ_training"];
$educ_training= @str_replace("'", "", $educ_training); 
$educ_training= @htmlspecialchars($educ_training);
$educ_training= @stripslashes($educ_training);
$educ_training= @str_replace("=", "", $educ_training);
$educ_training= @str_replace(";", "", $educ_training);

$seagoing_work = @$_POST["seagoing_work"];
$seagoing_work= @str_replace("'", "", $seagoing_work); 
$seagoing_work= @htmlspecialchars($seagoing_work);
$seagoing_work= @stripslashes($seagoing_work);
$seagoing_work= @str_replace("=", "", $seagoing_work);
$seagoing_work= @str_replace(";", "", $seagoing_work);

$non_seagoing_work = @$_POST["non_seagoing_work"];
$non_seagoing_work= @str_replace("'", "", $non_seagoing_work); 
$non_seagoing_work= @htmlspecialchars($non_seagoing_work);
$non_seagoing_work= @stripslashes($non_seagoing_work);
$non_seagoing_work= @str_replace("=", "", $non_seagoing_work);
$non_seagoing_work= @str_replace(";", "", $non_seagoing_work);

$view = @$_POST["view"];
$view = @str_replace("'", "", $view); 
$view = @htmlspecialchars($view);
$view = @stripslashes($view);
$view = @str_replace("=", "", $view);
$view = @str_replace(";", "", $view);


$terms = @$_POST["terms"];

if($terms == "")
{ 
$terms_error = "<font color='red'>Required!</font>";
$sw = 1;
}


if ($sw == 1)
{
include "./add_seaman.php";
exit;
}

$name = $first_name . $middle_name . $last_name;
$birthday = $month . " " . $day . "," . " " . $year;

if ($birthday == " , ")
{
include "./add_seaman.php";
exit;
}


  function generateID($plength)
    {
        $chars = 'ABCDEFG4H389JKLMNP567QRSTUVWXYZ';
    	mt_srand(microtime() * 1000000);
        for($i = 0; $i < $plength; $i++)
        {
         $key = mt_rand(0,strlen($chars)-1);
         $pwd = $pwd . $chars{$key};
        }
        for($i = 0; $i < $plength; $i++)
        {
		$key1 = mt_rand(0,strlen($pwd)-1);
		$key2 = mt_rand(0,strlen($pwd)-1);
		$tmp = $pwd{$key1};
		$pwd{$key1} = $pwd{$key2};
		$pwd{$key2} = $tmp;
        }
        return $pwd;
    }
    $newid = generateID(8);
    $newpassword = md5($newid);
	
	
	$connect = @mysql_pconnect($dbhost,$dbusername,$dbuserpassword); 
	$result = @mysql_db_query($dbname,"SELECT * from job_seeker where (last_name='$last_name' and middle_name = '$middle_name' and first_name = '$first_name') or email = '$email'");
	$row = @mysql_fetch_array($result);
	if($row == 0)
    {
    $query = "insert into job_seeker (first_name,middle_name,last_name,address,email,password,birthday,gender,city,phone,date,nationality,status,children,religion,language,passport_country,passport_no,passport_issued,passport_valid,sbook_country,sbook_no,sbook_issued,sbook_valid,competence,certificates,merits,educ_training,seagoing_work,non_seagoing_work,id,prefer_job,view,cellphone,verification) values ('$first_name','$middle_name','$last_name','$address','$email','$newpassword','$birthday','$sex','$city','$phone',now(),'$nationality','$status','$children','$religion','$language','$passport_country','$passport_no','$passport_issued','$passport_valid','$sbook_country','$sbook_no','$sbook_issued','$sbook_valid','$competence','$certificates','$merits','$educ_training','$seagoing_work','$non_seagoing_work','$newid','$prefer_job','$view','$cellphone','y')";

  $result = mysql_query($query) or die ("walang naisulat"); 
  
 $headers = 'From: PinoySeaman <noreply@pinoyseaman.com>' . "\r\n" .
   'Reply-To: PinoySeaman <noreply@pinoyseaman.com>' . "\r\n" .
   'MIME-Version: 1.0' . "\r\n" .
   'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
   'X-Mailer: PHP/' . phpversion();


 
  $email_message = "
  <font size = '2' face = 'verdana'>Welcome to PinoySeaman $first_name!, \n Below is your login account.\n \n
  Email : $email \n
  Password : $newid \n\n
  ";
  
  $email_message = nl2br($email_message);
  mail($email, "Welcome to PinoySeaman", $email_message, $headers); 

 mysql_free_result($result);
 
 
  $link = "seaman_login.php";  
  $message =  "<font color='blue'>Registration Successful! your pinoyseaman auto generated password was forwarded on your email ( $email ). <br/> Please check both inbox and spam folder.</font>  
  ";
  include "./action.php"; 
  exit;
  }
  
  $link = "index.php";
  $message =  "<font color='red'>Existing record on the database...<br>if you wish to use your existing record you may use the password retrieve form on the seaman login page. <br>Or you may contact us at admin@pinoyseaman.com</font>";
  include "./action.php"; 
  exit;
?>