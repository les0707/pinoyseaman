<?
session_start();
$url = $_SERVER['HTTP_REFERER'];
$ip = $_SERVER['REMOTE_ADDR']; 
$message = "$url <br> $ip";

include "./connect.php";
$connect = @mysql_pconnect($dbhost,$dbusername,$dbuserpassword); 
$result = @mysql_db_query($dbname,"SELECT * from search");
$query = "insert into search (url,ip,date) values('$url','$ip','$datenow')";
$result = @mysql_query($query);
mysql_close();
?>

<HTML>
<HEAD>
<TITLE>PinoySeaman.com - trabahong seaman isang click na lang!</TITLE>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<meta name="copyright" content="Copyright © 2006 - PinoySeaman.com. All rights reserved.">
<meta name="keywords" content="job posting,job search,maritime jobs,seaman jobs,job posting sites,job listing,job site, jobs asia,job  opportunities,international job ad listings,resume, resume database,shipping agency,maritime agency,manning philippines,pinoyseaman,filipino seaman jobs,seaman jobs,dyowel designs">
<meta name="description" content="Maritime Jobs,Seaman Jobs,Job search ,job posting site,jobseekers resume database,jobs employment vacancy listing,career advertising online Philippines">
<LINK href="pinoy.css" 
type=text/css rel=stylesheet>

<SCRIPT language=JavaScript>
<!--
//By Mike at XanthNJ@aol.com
// Use the following three variables to set up the message:
var msg = "Welcome to PINOYSEAMAN.COM, Post your Job Requirements now! For free estimates and quotations email us at info@pinoyseaman.com."
var delay = 60
var startPos = 127

// Don't touch these variables:
var timerID = null
var timerRunning = false
var pos = 0

// Crank it up!
StartScrolling()

function StartScrolling(){
    // Make sure the clock is stopped
    StopTheClock()

    // Pad the message with spaces to get the "start" position
    for (var i = 0; i < startPos; i++) msg = " " + msg

    // Off we go...
    DoTheScroll()
}

function StopTheClock(){
    if(timerRunning)
        clearTimeout(timerID)
    timerRunning = false
}

function DoTheScroll(){
    if (pos < msg.length)
        self.status = msg.substring(pos, msg.length);
    else
        pos=-1;
    ++pos
    timerRunning = true
    timerID = self.setTimeout("DoTheScroll()", delay)
}
//-->
</SCRIPT>

<style type="text/css">
<!--
body {
margin-left: 0px;
margin-top: 0px;
margin-right: 0px;
margin-bottom: 0px;
}
.style3 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	color: #FF0000;
}
.style4 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
</HEAD>
<BODY background="images/back.gif">
<a name="top"></a>
<br>
<TD vAlign=top><table width="10" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#000000">
  <tr>
    <td><table width="10" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
      <tr>
        <td><img src="images/logo.jpg" width="765" height="220"></td>
      </tr>
      <tr>
        <td background="images/navleft.gif"><? include "./menu.php"; ?></td>
      </tr>
      <tr>
        <td bgcolor="#000000"><table width="100%" border="0" cellspacing="3" cellpadding="3">
          <tr>
            <td><font color="#FFFFFF"><strong>PinoySeaman Website Statistics as of <? echo date('l, F j, Y a'); ?></strong></font></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="5" cellpadding="5">
          <tr>
            <td><? 
$id = @$_SESSION["seeker_id"];
$pass = @$_SESSION["seeker_pass"];

include "./connect.php";
// $datenow = date("Y-m-d");
$connect = @mysql_pconnect($dbhost,$dbusername,$dbuserpassword);
$query = "SELECT * from employer where online = 'y' and date > '$datenow'";
$result = @mysql_db_query($dbname,$query);
$row = @mysql_fetch_array($result);
$a = "SELECT COUNT(*) FROM employer "; 
$b = @mysql_query($a);
$c = @mysql_fetch_array($b);

$query = "SELECT * from job_seeker where email = '$id' and password = '$pass'";
$result = @mysql_db_query($dbname,$query);
$row = @mysql_fetch_array($result);
$name = $row["first_name"] . " " . $row["middle_name"] . " " . $row["last_name"];
$query2 = "SELECT COUNT(*) FROM job_seeker"; 
$numguests = @mysql_query($query2);
$numguest = @mysql_fetch_array($numguests);

$query4 = "SELECT COUNT(*) FROM jobs where mark = 'y'"; 
$numguests4 = @mysql_query($query4);
$total_job_posted = @mysql_fetch_array($numguests4);


$query5= "SELECT COUNT(*) FROM action where action like '%Job application%'"; 
$numguests5 = @mysql_query($query5);
$total_applicants = @mysql_fetch_array($numguests5);

@mysql_close();
?>
              <table width="100%" border="0" cellspacing="2" cellpadding="2">
                <TR>
                  <TD width="48%"><a href="seaman_prefer_job.php"><strong>Registered Seaman</strong></a> : <strong> <? echo $numguest[0]; ?> </strong></TD>
                  <TD width="52%">No. of Jobs Posted : <strong><? echo $total_job_posted[0]; ?></strong> </TD>
                </TR>
                <TR>
                  <TD><a href="company_list.php"><strong>Registered Shipping Company</strong></a> : <strong><? echo $c[0]; ?></strong></TD>
                  <TD>Job Applications : <strong><? echo $total_applicants[0]; ?></strong></TD>
                </TR>
              </TABLE></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td bgcolor="#000000"><table width="100%" border="0" cellspacing="3" cellpadding="3">
          <tr>
            <td><strong><font color="#FFFFFF">Companies 
            Hiring this Week</font></strong></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="5" cellpadding="5">
          <tr>
            <td><?     
								//include "./connect.php";  
								$connect = @mysql_pconnect($dbhost,$dbusername,$dbuserpassword);
								$query = "SELECT * from jobs where mark <> '' and expiry >= '$datenow' group by company_code order by company_name asc";
								$result = @mysql_db_query($dbname,$query);
								$count = @mysql_num_rows($result);
								?>
              <table width="100%" align="center" cellpadding="2" cellspacing="2">
                <?
								for ($i=1; $i<=$count; $i++) 
								{
								$row = @mysql_fetch_array($result);
								if ($i % 2) 
								{ 
								?>
                <TR>
                  <TD width=50%><a href="display_company.php?id=<? echo $row["company_code"]; ?>"><strong> <? echo $row["company_name"]; ?></strong></a> </TD>
                  <? 
									}
									else 
									{ 
									?>
                  <TD width=50%><a href="display_company.php?id=<? echo $row["company_code"]; ?>"> <strong><? echo $row["company_name"]; ?></strong></a> </TD>
                </TR>
                <?
									}
									}
								  ?>
              </TABLE>
              <br>
              <br>
              <a href="add_employer.php"><strong><font face="verdana" size="2" color="red">Post your Job requirements, Click here to REGISTER </font></strong></a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td bgcolor="#000000"><table width="100%" border="0" cellspacing="3" cellpadding="3">
          <tr>
            <td><strong><font color="#FFFFFF">Now 
            Hiring</font></strong></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="5" cellpadding="5">
          <tr>
            <td><? 
								//include "./connect.php";  
								$connect = @mysql_pconnect($dbhost,$dbusername,$dbuserpassword);
								$query = "SELECT * from jobs WHERE mark='y' and expiry >= '$datenow' group by job_title order by job_title asc";
								$result = @mysql_db_query($dbname,$query);
								$count = @mysql_num_rows($result);
								?>
              <table width="100%" align="center" cellpadding="2" cellspacing="2">
                <?
								for ($i=1; $i<=$count; $i++) 
								{
								$row = @mysql_fetch_array($result);
								if ($i % 2) 
								{ 
								?>
                <TR>
                  <TD width=50%><a href="display_company3.php?id=<? echo $row["job_title"]; ?>"><strong><? echo $row["job_title"]; ?></strong></a> </TD>
                  <? 
									}
									else 
									{ 
									?>
                  <TD width=50%><a href="display_company3.php?id=<? echo $row["job_title"]; ?>"> <strong><? echo $row["job_title"]; ?></strong></a> </TD>
                </TR>
                <?
								  }
								  }
								  ?>
              </TABLE>
              <a href="display_jobs.php" class="style4"><br>
              <br>
Click here to Display all Jobs </a>
<BR>
<strong><a href="signup.php"><font face="verdana" size="2" color="red">All Seaman post your resume now, Click here to REGISTER</font></a></strong> <span class="style3">(Free Registration ) </span></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left" valign="top" bgcolor="#000000"><table width="100%" border="0" cellspacing="3" cellpadding="3">
          <tr>
            <td><strong><font color="#FFFFFF">Registered Shipping Company Logo </font></strong></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="5" cellpadding="5">
          <tr>
            <td><div align="center"><a href="http://www.adamsonphil.com/" target="_blank"><img src="logo/adamson_small.jpg" alt="Adamson Phil Inc " hspace="2" border="0"></a><a href="http://www.cfsharp.com" target="_blank"> <img src="logo/cfsharp_small.jpg" alt="C.F.Sharp Crew Management, Inc. " border="0"></a> <a href="http://www.seascor.com.ph" target="_blank"><img src="logo/seascorp_small.jpg" alt="SOUTHEAST ASIA SHIPPING CORPORATION " hspace="2" border="0"></a> <img src="logo/cman_small.jpg" alt="C-Man Maritime Inc. "> <a href="http://www.diamond-h.com.ph/" target="_blank"><img src="logo/dh_small.jpg" alt="Diamond-H Marine Services &amp; Shipping Agency Inc. " hspace="2" border="0"></a> <img src="logo/alster_small.jpg" alt="ALSTER INTL SHIPPING SERVICES, INC. "><br>
                <img src="logo/asm_small.jpg" alt="ASSOCIATED SHIP MANAGEMENT SERVICES INC. "><a href="http://www.uplines.net" target="_blank"><img src="logo/upl_small.jpg" alt="UNITED PHILIPPINE LINES, INC. " hspace="2" border="0"></a> <a href="http://www.crewserve.com.ph"><img src="logo/crew_small.jpg" alt="CREWSERVE INC. " border="0"></a><img src="logo/vest_small.jpg" alt="VESTLAND MARITIME CORPORATION " hspace="2"><a href="www.pentaships.net.ph" target="_blank"><img src="logo/pentagon_small.jpg" alt="Pentagon International Shipping Services, Inc. " width="67" height="60" border="0"></a><img src="logo/pomi_small.jpg" alt="PACIFIC OCEAN MANNING INC. " width="96" height="70" hspace="2"> <img src="logo/amaya_small.jpg" alt="AMAYA SHIPPING, INC. "> <img src="logo/globe_small.jpg" alt="GLOBEMASTER MARINE AGENCY,INC., " hspace="2"> <a href="http://www.epsilonhellas.com" target="_blank"><img src="logo/epsilon_small.jpg" alt="Epsilon Maritime Services" border="0"></a> <a href="http://www.friendmar.com.ph" target="_blank"><img src="logo/fmsi.jpg" alt="Friendly Maritime Services Inc." hspace="2" border="0"></a><img src="logo/cream_small.jpg" alt="CREAM Ship Management Inc. "><img src="logo/hernz_small.jpg" alt="Hernz Maritime Services Co." width="90" height="77"> <img src="logo/naess_small.jpg" alt="Naess Shipping Philippines Inc." width="90" height="90"><br>
                <br>
                <br>
              Advertise your website, <a href="mailto:webmaster@pinoyseaman.com"><strong>Send 
                your Logo now</strong></a></div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td bgcolor="#000000"><table width="100%" border="0" cellspacing="3" cellpadding="3">
          <tr>
            <td><strong><font color="#FFFFFF">Training 
            Centers / Schools</font></strong></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="5" cellpadding="5">
          <tr>
            <td><div align="center"><strong><a href="http://www.maap.edu.ph" target="_blank"><img src="logo/amosup.jpg" alt="Maritime Academy of Asia and the Pacific" border="0"><br>
              <br>
            </a><a href="mailto:admin@pinoyseaman.com">Advertise your Schools / Training Centers here</a></strong></div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td bgcolor="#000000"><table width="100%" border="0" cellspacing="3" cellpadding="3">
          <tr>
            <td><strong><font color="#FFFFFF">PinoySeaman 
            Testimonials and Shoutbox</font></strong></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="1" cellspacing="1" cellpadding="1">
          <tr>
            <td><div align="center">
              <table width="400" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                <TR>
                  <TD height="24" bgcolor="#FFFFFF"><iframe src = "testimonials.php" height="200" width="400" frameborder="0" scrolling="yes" marginheight="5" marginwidth="5"></iframe></TD>
                </TR>
              </TABLE>
              <br>
              <font color="#FF9900"><strong>Got something 
                                to say? </strong></font><strong><a href="post_testi.php"><br>
                                </a></strong><a href="post_testi.php"><strong>Post 
                                some Testimonials or anything you want to say</strong></a><strong>. </strong></div></td>
            <td><div align="center">
              <table width="298" height="198" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td><div align="center">
                      <table width="10%" border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
                        <tr>
                          <td><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="298" height="220">
                              <param name="movie" value="pmma1.swf">
                              <param name="quality" value="high">
                              <embed src="pmma1.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="298" height="220"></embed>
                          </object></td>
                        </tr>
                      </table>
                  </div></td>
                </tr>
              </table>
              <br>
              <a href="mailto:webmaster@pinoyseaman.com"><strong>Send 
                                  us your Photo</strong></a></div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td bgcolor="#000000"><table width="100%" border="0" cellspacing="3" cellpadding="3">
          <tr>
            <td><strong><font color="#FFFFFF">PinoySeaman Advertisements</font></strong></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="674" border="0" align="center" cellpadding="2" cellspacing="2">
          <tr>
            <td width="666" align="left" valign="top"><div align="center"><a href="http://www.myifone.net/index.htm" target="_blank"><img src="myifone.jpg" alt="8995358 / 8953603 and look for  Ms. Ruby Arguellez" vspace="5" border="0"></a><a href="http://www.mecotechnologies.com" target="_blank"><img src="meco.jpg" alt="for your computer needs " hspace="5" vspace="5" border="0"></a></div>
                </span></span>
                <div align="center">
                  <table width="10" border="0" cellspacing="1" cellpadding="1">
                    <tr>
                      <td><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="300" height="112">
                          <param name="movie" value="ebd.swf">
                          <param name="quality" value="high">
                          <embed src="ebd.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="300" height="112"></embed>
                      </object></td>
                      <td><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="300" height="112">
                          <param name="movie" value="loan.swf">
                          <param name="quality" value="high">
                          <embed src="loan.swf" width="300" height="112" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed>
                      </object></td>
                    </tr>
                  </table>
                </div></td>
          </tr>
          <tr>
            <td align="left" valign="top"><div align="center"><a href="http://www.gamefarmdirectory.com" target="_blank"><img src="images/gamefarmlogo.jpg" width="371" height="70" border="0" longdesc="http://www.gamefarmdirectory.com"></a><a href="mailto:joel.nilo@pinoyseaman.com"><img src="images/placead1.jpg" width="200" height="70" hspace="5" border="0"></a></div></td>
          </tr>
          <tr>
            <td align="left" valign="top"><div align="center"><a href="mailto:joel.nilo@pinoyseaman.com"><img src="images/placead2.jpg" width="500" height="100" border="0"></a></div></td>
          </tr>
          <tr>
            <td align="left" valign="top"><div align="center"><a href="http://www.phoenixfirebirdgamefarm.com" target="_blank"><img src="images/phoenix.jpg" alt="excellent, best priced battlefowls" width="649" height="126" border="0" longdesc="http://www.phoenixgamefarm.com"></a></div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><div align="center">
		<script type="text/javascript"><!--
											google_ad_client = "pub-9538632855753247";
											google_ad_width = 728;
											google_ad_height = 90;
											google_ad_format = "728x90_as";
											google_ad_type = "text";
											google_ad_channel ="";
											google_color_border = "2D6E89";
											google_color_bg = "FFFFFF";
											google_color_link = "003366";
											google_color_text = "000000";
											google_color_url = "0066CC";
											//--></script>
                                    <script type="text/javascript"
											src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
											</script>
		</div></td>
      </tr>
      <tr>
        <td><div align="center">
          <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="739" height="115">
            <param name="movie" value="images/ads_seaman.swf">
            <param name="quality" value="high">
            <param name="SCALE" value="noborder">
            <embed src="images/ads_seaman.swf" width="739" height="115" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" scale="noborder"></embed>
          </object>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFCC00"><? include "./footer.php";?></td>
      </tr>
    </table></td>
  </tr>
</table>
<BR> 
</BODY>
</HTML>