<?php
session_start();
$ip = $_SERVER['REMOTE_ADDR'];
$sw = 0;
 

$job_seeker_id = $_POST["job_seeker_id"];
$job_seeker_id = str_replace("'", "", $job_seeker_id); 
$job_seeker_id = htmlspecialchars($job_seeker_id);
$job_seeker_id = stripslashes($job_seeker_id);
$job_seeker_id = str_replace("=", "", $job_seeker_id);
$job_seeker_id = str_replace(";", "", $job_seeker_id);

if($job_seeker_id == "")
{ 
$job_seeker_id_error = "<strong>Required!</strong>";
$sw = 1;
}

//password
$job_seeker_password = $_POST["job_seeker_password"];
$job_seeker_password = str_replace("'", "", $job_seeker_password);
$job_seeker_password = str_replace(" ", "", $job_seeker_password); 
$job_seeker_password = htmlspecialchars($job_seeker_password);
$job_seeker_password = stripslashes($job_seeker_password);
$job_seeker_password = str_replace("=", "", $job_seeker_password);
$job_seeker_password = str_replace(";", "", $job_seeker_password);
$job_seeker_password = str_replace(" ", "", $job_seeker_password);

if($job_seeker_password == "")
{ 
$job_seeker_password_error = "<strong>Required!</strong>";
$sw = 1;
}

if ($sw == 1)
{
$link = "index.php";
$message =  "<font color='red'>Email and Password are required!</font>";
include "./action.php";
exit;
}


if (!filter_var($job_seeker_id, FILTER_VALIDATE_EMAIL)) {
$link = "index.php";
$message =  "<font color='red'>Email is invalid!</font>";
include "./action.php";
exit;
}


$job_seeker_password2 = md5($job_seeker_password);

include "./connect.php";
$link = mysqli_connect($dbhost,$dbusername,$dbuserpassword,$dbname) or die("Error " . mysqli_error($link));
$query = "SELECT * from job_seeker where email='$job_seeker_id' and password='$job_seeker_password2'" or die("Error" . mysqli_error($link));
$result = mysqli_query($link, $query);

while($row = mysqli_fetch_array($result))
{
 $activate = $row["password"];

//session starts here
$_SESSION["seeker_id"] = $job_seeker_id;
$_SESSION["seeker_pass"] = $job_seeker_password2;
$_SESSION["name"] = $row["first_name"] . " " . $row["last_name"];

// update action
$query = "insert into action (seaman,action,date,ip,time) values ('$job_seeker_id','Seaman Login Successful','$datenow','$ip','$timenow')" or die("Error" . mysqli_error($link));
$result = mysqli_query($link, $query);

// mark online
$query = "update job_seeker set online='y' where email='$job_seeker_id' and password='$job_seeker_password2'" or die("Error" . mysqli_error($link));
$result = mysqli_query($link, $query);

$message = "<font color=blue>Login Successful, please wait while transferring you to seaman admin page</font>";
$link = "seaman_panel.php";
include "./action.php";
mysqli_close($link);
mysqli_free_result($result);
exit;
}

// update action
$query = "insert into action (seaman,action,date,ip,time) values ('$job_seeker_id','Seaman Login Failed','$datenow','$ip','$timenow')" or die("Error" . mysqli_error($link));
$result = mysqli_query($link, $query);


//$link = "seaman_login.php";
$message =  "<font color='red'><br />Login Failed!, please check your login details...</font><br/>";
$link = "seaman_panel.php";
include "./action.php";
exit;
mysqli_close($link);
mysqli_free_result($result);
?>