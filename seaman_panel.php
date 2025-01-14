<?php 
session_start();
include "./connect.php";

if(!isset($_SESSION["seeker_id"]))
{
header("location: seaman_login.php");
exit;
}
if(!isset($_SESSION["seeker_pass"]))
{
header("location: seaman_login.php");
exit;
}
$id = $_SESSION["seeker_id"];
$pass = $_SESSION["seeker_pass"];
?>
<html>
<head>
<?php
include "./meta.php";
?>
<style type="text/css">
<!--
.style1 {
	color: #FF0000
}
.style2 {
	color: #000000
}
-->
</style>
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table id="Table_01" width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top" background="images/index_01.jpg"><img src="images/logo.jpg" width="223" height="50"></td>
  </tr>
  <tr>
    <td align="left" valign="top" background="images/index_03.jpg"><table width="1024" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><?php include "./seaman_menu.php";?>
            <br />
            <table width="100%" border="0" cellspacing="2" cellpadding="0">
              <tr>
                <td width="1001" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td bgcolor="#305067"><strong>Seaman Admin Panel </strong></td>
                    </tr>
                    <tr>
                      <td><br />
                        <span class="black1">
                        <?php
					  $link = mysqli_connect($dbhost,$dbusername,$dbuserpassword,$dbname) or die("Error " . mysqli_error($link));
					  $query = "SELECT email,password,prefer_job,first_name,last_name from job_seeker where email='$id' and password='$pass'" or die("Error" . mysqli_error($link));
					  $result = mysqli_query($link, $query);
					  $row = mysqli_fetch_array($result);
					  
					  $job_match = $row["prefer_job"];
					  if($job_match == "")
					  {
					  $job_match = "enter your preferred job";
					  }
					  $name = $row["first_name"] . " " . $row["last_name"];
					  ?>
                        <strong>Login :</strong> <?php echo $name; ?> <br />
                        <strong>Position :</strong> <?php echo $job_match; ?> (<a href="edit_seaman_job.php">update job position</a>)</span><br />
                        <br />
                        <br />
                        <span class="black1"><strong>Tip :</strong> <br>
                        For a greater chance of application please update your Sea Service work experience.&nbsp;<a href="edit_seaman_profile.php">Update now</a>. </span><br>
                        <br>
                        <br>
                        <br/>
                        <br/>
                        <br/></td>
                    </tr>
                    <tr>
                      <td bgcolor="#305067"><strong>List of Manning Agency hiring for <font color="#ffffff"><?php echo $job_match; ?></font></strong></td>
                    </tr>
                    <tr>
                      <td><br />
                        <br />
                        <?php
						$query = "SELECT * FROM jobs WHERE job_title = '$job_match' and expiry > '$datenow' AND mark='y' ORDER BY company_name asc" or die("Error" . mysqli_error($link));
					$result = mysqli_query($link, $query);
					$count = mysqli_num_rows($result);
					?>
                        <table width="100%" align="center" cellpadding="4" cellspacing="4">
                          <?php
					for ($i=1; $i<=$count; $i++)
					{
					$row = mysqli_fetch_array($result);
					if ($i % 2)
					{
					?>
                          <tr>
                            <td width="54%"><a href = "display_company2.php?code=<?php echo $job_match; ?>&company_code=<?php echo $row["company_code"]; ?>" target="windowName"
   onclick="window.open(this.href,this.target,'width=800,height=500,scrollbars=yes');
            return false;">
                              <?php $company_name = $row["company_name"]; 
				$company_name = @str_replace("*", "&", $company_name);
				$company_name = @str_replace('^', "'", $company_name); 
				echo $company_name;?>
                              </a></td>
                            <?php
						  }
						  else
						  {
						  ?>
                            <td width="46%"><a href = "display_company2.php?code=<?php echo $job_match; ?>&company_code=<?php echo $row["company_code"]; ?>" target="windowName"
   onclick="window.open(this.href,this.target,'width=800,height=500,scrollbars=yes');
            return false;">
                              <?php $company_name = $row["company_name"]; 
				$company_name = @str_replace("*", "&", $company_name);
				$company_name = @str_replace('^', "'", $company_name); 
				echo $company_name;?>
                              </a></td>
                          </tr>
                          <?php
						}
						}
						?>
                        </table>
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br /></td>
                    </tr>
                    <tr>
                      <td bgcolor="#305067"><strong>Your Application History </strong></td>
                    </tr>
                    <tr>
                      <td><br />
                        <font color="black">* list of manning agencies that you applied</font><br />
                        <br />
                        <?php
					$query = "SELECT * from job_applicants where email='$id' and mark !='x' order by company asc" or die("Error" . mysqli_error($link));
					$result = mysqli_query($link, $query);
					
					while($row = mysqli_fetch_array($result)) 
					{
					?>
                        <table width="100%" border="0" cellpadding="5" cellspacing="2" bgcolor="#FFFFFF">
                          <tr >
                            <td width="54%" height="20" bgcolor="#F0F0F0" class="black1" ><?php $company_name = $row["company"];
						  $company_name = str_replace("*", "&", $company_name);
						  $company_name = str_replace('^', "'", $company_name);
						  echo $company_name; ?>
                              <div align="right"></div></td>
                            <td width="24%" bgcolor="#F0F0F0" class="black1"><?php echo $row["job_hiring"]; ?></td>
                            <td width="22%" bgcolor="#F0F0F0" ><div align="right"><a href="cancel_apply.php?cancel_code=<?php echo $row["code"];?>" onClick="return confirm('Are you sure you want to cancel your application?')"><strong>Cancel  my application</strong></a></div></td>
                          </tr>
                        </table>
                        <?php 
						  }
						  ?>
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br /></td>
                    </tr>
                    <tr>
                      <td bgcolor="#305067"><strong>Advertisement</strong></td>
                    </tr>
                    <tr>
                      <td><br />
                        
                        <br />
                        <br /><br>
                        </div>
                        <br />
                        <br /></td>
                    </tr>
                  </table></td>
                <td width="17" align="left" valign="top"><?php include "./seaman_side.php";?></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="left" valign="top" bgcolor="#000000"><?php include "./bottom.php";
		mysqli_close($link);
		mysqli_free_result($result);
		?></td>
  </tr>
</table>
</body>
</html>
