<?php
include 'connect.php';
include 'includes/header.php';
include 'includes/nav.php';
?>

<body>

<div class="main-content">
    <div class="company-content">

        <div class="company-header-container"> 
            <strong>PinoySeaman Account Support</strong>
        </div>

        <div class="seaman-registration-form"> 
        <!------------------------------ form --------------------------->
            <form action="employer_login_forgot_verify.php" method="post" name="employerhelp" id="employerhelp"  onsubmit="return validateForm_employer_help()">
                <div class="formbold-form-step-1 active">
                    <p>To retreive your Employer ID and Password please enter the email (primary email) you used to register your PinoySeaman account.</p>
                    <div class="formbold-input-flex">
                        <div>
                            <label for="lastname" class="formbold-form-label"> Email </label>
                            <input type="email" name="email" id="email"class="formbold-form-input" placeholder="Your employer email"/>
                        </div>
                    </div>
                        <div class="btn-form">
                            <input class="contact-submit" type="submit" value="Retrieve" name="Submit">
                        </div>
                        <br>
                        <span>Not yet registered?</span> <a href="add_employer.php">signup now</a>
                </div>
            </form>
        </div>
    </div>

    <?php include 'includes/aside.php' ?>

</div>

</body>
<?php include 'includes/footer.php' ?>