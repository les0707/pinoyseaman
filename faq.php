<?php
include 'connect.php';
include 'includes/header.php';
include 'includes/nav.php';
?>

<body>

  <div class="main-content">

    <div class="company-content">
      <div class="company-header-container">
        <strong>JobSeeker (Seaman)</strong>
      </div>
      <div class="hiring-container">
        <div class="hiring-content">
            <strong class="content-strong"> Register</strong>
            <p>By registering a pinoyseaman account, you can enjoy the following member benefits. <br>
            - Create online resume <br>
            - Apply on the Job posted by the companies<br>
            - post comments on the message board
            </p>

            <strong class="content-strong">How to Register </strong>
            <p>visit seaman registration page <span><a href="add_seaman.php">(click here)</a></span><br>
            - fill up the form correctly, all fields marked with (<span style="color: red; padding: 3px;">* </span>) are required <br>
            - enter a valid email address<br>
            - if successfull registration, check your email for your auto-generated password.<br> 
            Check on both INBOX and SPAM folder</p>

            <strong class="content-strong">I didn't receive my password after i register, what will i do?</strong>
            <p>You can retrieve your password by visiting the FORGOT PASSWORD page <span><a href="seaman_help.php"> (click here)</a></span></p>

            <strong class="content-strong">I am registered as SEAMAN and I forgot my password, how do i retrieve it?</strong>
            <p>You can retrieve your password by visiting the FORGOT PASSWORD page <span><a href="seaman_help.php"> (click here)</a></span><br>
            Fill up the form and your Auto Generated Password will be forwarded to your email.
            <br><br>
            or you may send email to admin@pinoyseaman.com and provide the following details (Full Name, birthday, email, address)</p>
                            
            <strong class="content-strong">Is there any FEE for seaman registration?</strong>
            <p>There are no charges for all seamen who are interested to register. All you have to do is fill out the registration form in our website. 
            You must have a valid email address where your pinoyseaman login password can be sent to. 
            You will need this password for access to apply on the different job offerings posted in our website.
            <br><br>
            note : your profile will be forwarded to the company when applying to the jobs posted on this website.</p>

            <strong class="content-strong">Can i update my Profile, Email and Password?</strong>
            <p>You can retrieve your password by visiting the FORGOT PASSWORD page <span><a href="seaman_login.php"> (click here)</a></span></p>
                            
            <strong class="content-strong">My PROFILE is not updated after i hit the update button, what will i do?</strong>
            <p>maybe your browser's cookie functionality is turned off or disabled. You may enable your browser cookies or use other browser.</p>
        </div>
       
      </div>

    </div>

    <?php include 'includes/aside.php' ?>

  </div>

</body>
<?php include 'includes/footer.php' ?>