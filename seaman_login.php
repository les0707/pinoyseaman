<?php
include 'connect.php';
include 'includes/header.php';
include 'includes/nav.php';
?>

<body>

<div class="main-content">
    <div class="company-content">

        <div class="company-header-container"> 
            <strong>Seaman Login</strong>
        </div>

        <div class="seaman-registration-form"> 
        <!------------------------------ form --------------------------->
            <form action="seaman_login_verify.php" method="post"  name="seaman1" id="seaman1" onsubmit="return validateForm_add_seaman()">
                <div class="formbold-form-step-1 active">
                    <div class="formbold-input-flex">
                        <div>
                            <label for="lastname" class="formbold-form-label"> Email: </label>
                            <input name="job_seeker_id" type="text" id="job_seeker_id" class="formbold-form-input" placeholder="Enter your email"/>
                        </div>

                        <div>
                            <label for="lastname" class="formbold-form-label"> Password: </label>
                            <input name="job_seeker_password" type="password" id="textfield4" class="formbold-form-input" placeholder="Enter your password"/>
                        </div>

                    </div>
                        <div class="btn-form">
                            <input class="contact-submit" type="submit" name="button2" id="button2">
                        </div>
                        <br>
                        <a href="seaman_help.php">Forgot your Password?</a><br>
                        <a href="add_seaman.php">Register Now</a>
                </div>
            </form>
        </div>

            <div class="company-header-container">
            <strong>Now Hiring !!! Please <a href="add_seaman.php">register</a> and  apply for the jobs below.</strong>
            </div>
            <div class="hiring-container">
                <div class="hiring-content">
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=AB%20/%20CK">AB / CK</a> 
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Able%20Seaman">Able Seaman</a> 
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Captain%20/%20Master">Captain / Master</a> 
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Chief%20Engineer">Chief Engineer</a> 
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Deck%20Fitter">Deck Fitter</a> 
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Electric%20Technical%20Officer%20(ETO)">Electric Technical Officer (ETO)</a> 
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Electrical%20Engineer">Electrical Engineer</a> 
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Fourth%20Engineer">Fourth Engineer</a> 
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Master%20Mariner">Master Mariner</a> 
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Motorman">Motorman</a> 
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Ordinary%20Seaman">Ordinary Seaman</a>
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=OS%20/%20Painter">OS / Painter</a>
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Pumpmen">Pumpmen</a>
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Second%20Engineer">Second Engineer</a>
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Steward">Steward</a>
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Third%20Engineer">Third Engineer</a>
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Welder">Welder</a>
                </div>
                <div class="hiring-content">
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=AB%20/%20Cook">AB / Cook</a>
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Bosun">Bosun</a>
                    <a href=" https://www.pinoyseaman.com/display_company3.php?id=Chief%20Cook">Chief Cook</a>
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Chief%20Officer">Chief Officer</a>
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Deck%20Officer">Deck Officer</a>
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Electrical%20Cadet">Electrical Cadet</a>
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Electrician">Electrician</a>
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Fitter">Fitter</a>
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Gas%20Engineer">Gas Engineer</a>
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Messman">Messman</a>
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Oiler">Oiler</a>
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=OS%20/%20Cook">OS / Cook</a>
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Plumber">Plumber</a>
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Second%20Cook">Second Cook</a>
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Second%20Officer%20/%20Second%20Mate">Second Officer / Second Mate</a>
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=STOREKEEPER">STOREKEEPER</a>
                    <a href="https://www.pinoyseaman.com/display_company3.php?id=Wiper">Wiper</a>
                </div>
            </div>
    </div>

    <?php include 'includes/aside.php' ?>

</div>

</body>
<?php include 'includes/footer.php' ?>