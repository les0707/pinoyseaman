<?php
session_start();
include "connect.php";

$company_name = $_POST["company_name"];
$company_name = stripslashes($company_name);
$company_name = str_replace("'", "^", $company_name);
$company_name = str_replace("&", "*", $company_name);
$company_name = str_replace('"', "", $company_name);
$company_name = str_replace(';', "", $company_name);
$company_name = htmlspecialchars($company_name);

if ($company_name == "") {
    $company_name_error = "<font color='red' size='2'><br>Company Name is required.</font>";
    $sw = 1;
}

$company_address = $_POST["company_address"];
$company_address = stripslashes($company_address);
$company_address = str_replace("'", "^", $company_address);
$company_address = str_replace("&", "*", $company_address);
$company_address = str_replace('"', "", $company_address);
$company_address = str_replace(';', "", $company_address);
$company_address = htmlspecialchars($company_address);

if ($company_address == "") {
    $company_address_error = "<font color='red' size='2'><br>Address is required.</font>";
    $sw = 1;
}

$phone = $_POST["phone"];
$phone = stripslashes($phone);
$phone = str_replace("'", "^", $phone);
$phone = str_replace("&", "*", $phone);
$phone = str_replace('"', "", $phone);
$phone = str_replace(';', "", $phone);
$phone = htmlspecialchars($phone);

if ($phone == "") {
    $company_phone_error = "<font color='red' size='2'><br>Phone Number is required.</font>";
    $sw = 1;
}

$email = $_POST["email"];
$email = stripslashes($email);
$email = str_replace("'", "^", $email);
$email = str_replace("&", "*", $email);
$email = str_replace('"', "", $email);
$email = str_replace(';', "", $email);
$email = htmlspecialchars($email);

if (empty($email)) {
    $company_email_error = "<font color='red' size='2'><br>Primary Email is required.</font>";
    $sw = 1;
} else {
    $check = substr_count($email, '@');
    if ($check == 0) {
        $company_email_error = "<font color='red' size='2'><br>Email format is invalid.</font>";
        $sw = 1;
    }
}

//email2 check
$email2 = $_POST["email2"];
$email2 = stripslashes($email2);
$email2 = str_replace("'", "^", $email2);
$email2 = str_replace("&", "*", $email2);
$email2 = str_replace('"', "", $email2);
$email2 = str_replace(';', "", $email2);
$email2 = htmlspecialchars($email2);


if (!empty($email2)) {
    $check = substr_count($email2, '@');
    if ($check == 0) {
        $company_email2_error = "<font color='red' size='2'><br>Email format is invalid.</font>";
        $sw = 1;
    }
}


$contact = $_POST["contact"];
$contact = stripslashes($contact);
$contact = str_replace("'", "^", $contact);
$contact = str_replace("&", "*", $contact);
$contact = str_replace('"', "", $contact);
$contact = str_replace(';', "", $contact);
$contact = htmlspecialchars($contact);

if ($contact == "") {
    $company_contact_error = "<font color='red' size='2'><br>Contact Person is required.</font>";
    $sw = 1;
}

$website = $_POST["website"];
$website = stripslashes($website);
$website = str_replace("'", "^", $website);
$website = str_replace("&", "*", $website);
$website = str_replace('"', "", $website);
$website = str_replace(';', "", $website);
$website = htmlspecialchars($website);


$company_profile = $_POST["company_profile"];
$company_profile = stripslashes($company_profile);
$company_profile = str_replace("'", "^", $company_profile);
$company_profile = str_replace("&", "*", $company_profile);
$company_profile = str_replace('"', "", $company_profile);
$company_profile = str_replace(';', "", $company_profile);
$company_profile = htmlspecialchars($company_profile);

if ($company_profile == "") {
    $company_profile_error = "<font color='red' size='2'><br>Company Description is required.</font>";
    $sw = 1;
}


$password1 = $_POST["password1"];
$password1 = stripslashes($password1);
$password1 = str_replace("'", "^", $password1);
$password1 = str_replace("&", "*", $password1);
$password1 = str_replace('"', "", $password1);
$password1 = str_replace(';', "", $password1);
$password1 = htmlspecialchars($password1);

if (empty($password1)) {
    $company_password1_error = "<font color='red' size='2'><br>Password is required.</font>";
    $sw = 1;
} else {
    // Check if password is alphanumeric
    if (!ctype_alnum($password1)) {
        $company_password1_error = "<font color='red' size='2'><br>Password must be Alphanumeric format.</font>";
        $sw = 1;
    }

    // Check password length
    if (strlen($password1) >= 8) {
        $company_password1_error = "<font color='red'>Password must have at least 8 characters.</font>";
        $sw = 1;
    }
}

if (isset($_POST['terms'])) {
} else {
    $company_terms_error = "<font color='red' size='2'><br>Company must agree to the Pinoy Seaman Terms and Conditions.</font>";
    $sw  = 1;
}


$answer = $_POST["answer"];
if ($answer == "") {
    $answer_error = "<font color='red' size='2'><br>Answer is required.</font>";
    $sw = 1;
}


$answerx = $_SESSION["answerx"];
if ($answer <> $answerx) {
    $answer_error = "<font color='red' size='2'><br>Answer is incorrect.</font>";
    include "./add_employer.php";
    exit;
}


if ($sw == 1) {
    include "./add_employer.php";
    exit;
}

$password2 = $password1;
$password1 = md5($password1);

$link = mysqli_connect($dbhost, $dbusername, $dbuserpassword, $dbname) or die("Error connecting database" . mysqli_error($link));
$query = "SELECT * from employer WHERE email='$email' order by code asc" or die("Error" . mysqli_error($link));
$result = mysqli_query($link, $query);
$row = mysqli_fetch_array($result);


if ($row == 0) {
    function generateID($plength)
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTHSNDGYCUCYDHDKEMDJDHKBSHSGRJDHDGDGD';
        mt_srand(microtime() * 1000000);
        for ($i = 0; $i < $plength; $i++) {
            $key = mt_rand(0, strlen($chars) - 1);
            $pwd = $chars[$key];
        }
        for ($i = 0; $i < $plength; $i++) {
            $key1 = mt_rand(0, strlen($pwd) - 1);
            $key2 = mt_rand(0, strlen($pwd) - 1);
            $tmp = $pwd[$key1];
            $pwd[$key1] = $pwd[$key2];
            $pwd[$key2]
                = $tmp;
        }
        return $pwd;
    }

    $newid = generateID(8);

    $random_id_length = 8;
    $rnd_id = crypt(uniqid(rand(), 1));
    $rnd_id = strip_tags(stripslashes($rnd_id));
    $rnd_id = str_replace(".", "", $rnd_id);
    $rnd_id = strrev(str_replace("/", "", $rnd_id));
    $rnd_id = substr($rnd_id, 0, $random_id_length);


    $query2 = "INSERT INTO employer (id,company,address,phone,fax,contact,email,email2,email3,password,company_profile,date,website,logo,post,member_type,total_post,date_registered,company_code,verify,secret,date_modified)values('$newid','$company_name','$company_address','$phone','$fax','$contact','$email','$email2','$email3','$password1','$company_profile',DATE_ADD('$datenow',INTERVAL 7 DAY),'$website','companylogo.gif',' ','FREE','50','$datenow','$rnd_id',' ','$password2',now())" or die("Error" . mysqli_error($link));
    $result2 = mysqli_query($link, $query2);




    $headers = 'From: PinoySeaman <infopinoyseaman.com>' . "\r\n" .
        'Reply-To: PinoySeaman <infopinoyseaman.com>' . "\r\n" .
        'MIME-Version: 1.0' . "\r\n" .
        'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    $company_name = str_replace("^", "'", $company_name);
    $company_name = str_replace("*", "&", $company_name);

    $email_message = "<font face = 'verdana' size = '2'>
New employer registration.
<br><br>
Company Name : $company_name
<br>
Employer ID : $newid
<br>
Employer Address : $company_address
<br>
Phone Number : $phone
<br>
Contact Person : $contact
<br>
Primary Email : $email
<br>
Additional Email : $email2
<br>
Website : $website
<br>
Company Profile : $company_profile
<br>
Password : $password1
<br>
Random ID : $rnd_id
</font>";
    mail($admin_email, "PinoySeaman Company Registration", $email_message, $headers);

    $message = "<font color='blue'>Congratulations!, your account has been created. <br>However, registration requires account activation by PinoySeaman admin. <br> We will verify your account via phone call / email and  we will notify you once your account is activated.</font>";
    $link = "index.php";
    include "./action.php";

    mysqli_close($link);
    mysqli_free_result($result);
    exit;
} else {
    $message =  "<font color='red'>failed!, existing Employer data.</font>";
    $link = "add_employer.php";
    include "./action.php";

    mysqli_close($link);
    mysqli_free_result($result);
    exit;
}