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
            <form action="seaman_login_verify2.php" method="post"  name="seaman1" id="seaman1" onsubmit="return validateForm_seaman_login()">
                <div class="formbold-form-step-1 active">
                    <h3>Forgot your Pinoyseaman.com password?</h3>
                    <hr>
                    <div class="formbold-input-flex">
                        <div>
                            <label for="lastname" class="formbold-form-label"> Email: </label>
                            <input name="job_seeker_id" type="text" id="job_seeker_id" class="formbold-form-input" placeholder="Enter your email"/>
                            <p>this is the email address you used to register your PinoySeaman.com account</p>
                        </div>
                        

                    </div>
                        <div class="btn-form">
                            <input class="contact-submit" type="submit" name="button2" id="button2" value="Retrieve">
                        </div>
                    <br>
                    <hr>
                    <h4>
                    Forgot your PinoySeaman.com Registered Email?
                    </h4> <br>
                    <p>
                    send email to info (at) pinoyseaman (dot) com
                    </p> <br>
                    <p>
                    To verify that you are the owner of the account please provide the below details on the email.<br> <br>
                    Full Name / Home address / Birthdate / Cellphone Number
                    </p>
                </div>
            </form>
        </div>
    </div>

    <?php include 'includes/aside.php' ?>

</div>

</body>
<?php include 'includes/footer.php' ?>