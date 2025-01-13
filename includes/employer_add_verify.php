<?php
session_start();
include "dbh.inc.php";

function sanitize_input($input) {
    $input = stripslashes($input);
    $input = str_replace(["'", "&", '"', ';'], ["^", "*", "", ""], $input);
    return htmlspecialchars($input);
}

function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function generateID($length) {
    $chars = 'ABCDEFGHIJKLMNOPQRSTHSNDGYCUCYDHDKEMDJDHKBSHSGRJDHDGDGD';
    $pwd = '';
    for ($i = 0; $i < $length; $i++) {
        $pwd .= $chars[mt_rand(0, strlen($chars) - 1)];
    }
    return str_shuffle($pwd);
}

$required_fields = [
    'company_name' => 'Company Name is required.',
    'company_address' => 'Address is required.',
    'phone' => 'Phone Number is required.',
    'email' => 'Primary Email is required.',
    'contact' => 'Contact Person is required.',
    'company_profile' => 'Company Description is required.',
    'password1' => 'Password is required.',
    'answer' => 'Answer is required.'
];

$errors = [];
$sw = 0;

foreach ($required_fields as $field => $error_message) {
    if (empty($_POST[$field])) {
        $errors[$field] = "<font color='red' size='2'><br>$error_message</font>";
        $sw = 1;
    } else {
        $$field = sanitize_input($_POST[$field]);
    }
}

if (!empty($email) && !validate_email($email)) {
    $errors['email'] = "<font color='red' size='2'><br>Email format is invalid.</font>";
    $sw = 1;
}

if (!empty($email2) && !validate_email($email2)) {
    $errors['email2'] = "<font color='red' size='2'><br>Email format is invalid.</font>";
    $sw = 1;
}

if (!empty($password1)) {
    if (!ctype_alnum($password1)) {
        $errors['password1'] = "<font color='red' size='2'><br>Password must be Alphanumeric format.</font>";
        $sw = 1;
    }
    if (strlen($password1) < 8) {
        $errors['password1'] = "<font color='red'>Password must have at least 8 characters.</font>";
        $sw = 1;
    }
}

if (!isset($_POST['terms'])) {
    $errors['terms'] = "<font color='red' size='2'><br>Company must agree to the Pinoy Seaman Terms and Conditions.</font>";
    $sw = 1;
}

if ($_POST['answer'] !== $_SESSION['answerx']) {
    $errors['answer'] = "<font color='red' size='2'><br>Answer is incorrect.</font>";
    include "../add_employer.php";
    exit;
}

if ($sw == 1) {
    include "../add_employer.php";
    exit;
}

$password2 = $password1;
$password1 = md5($password1);

$link = mysqli_connect($dbhost, $dbusername, $dbuserpassword, $dbname) or die("Error connecting database" . mysqli_error($link));
$query = "SELECT * FROM employer WHERE email='$email' ORDER BY code ASC";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_array($result);

if (!$row) {
    $newid = generateID(8);
    $rnd_id = substr(strrev(str_replace("/", "", str_replace(".", "", strip_tags(stripslashes(crypt(uniqid(rand(), 1))))))), 0, 8);

    $query2 = "INSERT INTO employer (id, company, address, phone, fax, contact, email, email2, email3, password, company_profile, date, website, logo, post, member_type, total_post, date_registered, company_code, verify, secret, date_modified)
               VALUES ('$newid', '$company_name', '$company_address', '$phone', '$fax', '$contact', '$email', '$email2', '$email3', '$password1', '$company_profile', DATE_ADD('$datenow', INTERVAL 7 DAY), '$website', 'companylogo.gif', ' ', 'FREE', '50', '$datenow', '$rnd_id', ' ', '$password2', NOW())";
    $result2 = mysqli_query($link, $query2);

    $headers = 'From: PinoySeaman <infopinoyseaman.com>' . "\r\n" .
               'Reply-To: PinoySeaman <infopinoyseaman.com>' . "\r\n" .
               'MIME-Version: 1.0' . "\r\n" .
               'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    $company_name = str_replace(["^", "*"], ["'", "&"], $company_name);

    $email_message = "<font face='verdana' size='2'>
                      New employer registration.<br><br>
                      Company Name: $company_name<br>
                      Employer ID: $newid<br>
                      Employer Address: $company_address<br>
                      Phone Number: $phone<br>
                      Contact Person: $contact<br>
                      Primary Email: $email<br>
                      Additional Email: $email2<br>
                      Website: $website<br>
                      Company Profile: $company_profile<br>
                      Password: $password1<br>
                      Random ID: $rnd_id
                      </font>";
    mail($admin_email, "PinoySeaman Company Registration", $email_message, $headers);

    $message = "<font color='blue'>Congratulations!, your account has been created. <br>However, registration requires account activation by PinoySeaman admin. <br> We will verify your account via phone call / email and we will notify you once your account is activated.</font>";
    $link = "index.php";
    include "../action.php";

    mysqli_close($link);
    mysqli_free_result($result);
    exit;
} else {
    $message = "<font color='red'>Failed!, existing Employer data.</font>";
    $link = "add_employer.php";
    include "../action.php";

    mysqli_close($link);
    mysqli_free_result($result);
    exit;
}
?>
