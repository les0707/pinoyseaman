<?php
session_start();
$answer = "";
include 'connect.php';
?>

<?php
include 'includes/header.php';
include 'includes/nav.php';
?>

<body>

    <div class="main-content">

        <div class="employer-content">
            <div class="company-header-container">
                <strong>Employer Registration (for Manning Agency registration only)</strong>
            </div>
            <div class="employer-list-content">
                <h2>Company Information</h2>
                <p><span style="color: red;">*</span> Indicates required fields.</p>
                <form action="includes/employer_add_verify.inc.php" name="add_employer" method="post">
                    <div class="form-group">
                        <?php
                        $company_name = @str_replace("^", "'", $company_name);
                        $company_name = @str_replace("*", "&", $company_name);
                        ?>
                        <label class="add-label">Company Name <span style="color: red;">*</span></label>
                        <input class="group-input" name="company_name" type="text" id="company_name" value="<?php echo $company_name; ?>" placeholder="Pinoy Seaman">
                        <?php echo $company_name_error; ?>
                    </div>

                    <div class="form-group">
                        <?php
                        $company_profile = @str_replace("^", "'", $company_profile);
                        $company_profile = @str_replace("*", "&", $company_profile);
                        ?>
                        <label class="add-label">Company Description<span style="color: red;">*</span></label>
                        <textarea name="company_profile" id="company_profile"><?php echo $company_profile; ?></textarea>
                        <?php echo $company_profile_error; ?>
                    </div>

                    <div class="form-group">
                        <label class="add-label">Address<span style="color: red;">*</span></label>
                        <textarea name="company_address" id="company_address"><?php echo $company_address; ?></textarea>
                        <?php echo $company_address_error; ?>
                    </div>


                    <div class="form-group">
                        <label class="add-label">Phone Number<span style="color: red;">*</span></label>
                        <input class="group-input" type="tel" name="phone" id="phone" value="<?php echo $phone; ?>" placeholder="09123456789">
                        <?php echo $company_phone_error; ?>
                    </div>

                    <div class="form-group">
                        <label class="add-label">Primary Email<span style="color: red;">*</span></label>
                        <input class="group-input" type="text" name="email" id="email" value="<?php echo $email; ?>" placeholder="primary@gmail.com">
                        <?php echo $company_email_error; ?>
                    </div>

                    <div class="form-group">
                        <label for="email" class="add-label">Additional Email</label>
                        <input class="group-input" type="text" name="email2" id="email2" value="<?php echo $email2; ?>" placeholder="secondary@gmail.com">
                        <?php echo $company_email2_error; ?>
                    </div>

                    <div class="form-group">
                        <label for="contact" class="add-label">Contact Person<span style="color: red;">*</span></label>
                        <input class="group-input" type="text" name="contact" id="contact" value="<?php echo $contact; ?>" placeholder="Juan Dela Cruz">
                        <?php echo $company_contact_error; ?>
                    </div>

                    <div class="form-group">
                        <label class="add-label">Website URL (If Applicable)</label>
                        <input class="group-input" type="text" name="website" id="website" value="<?php echo $website; ?>" placeholder="pinoyseaman.com">
                    </div>

                    <div class="form-group">
                        <label for="password" class="add-label">Login Password<span style="color: red;">*</span></label>
                        <input class="group-input" type="password" name="password1" id="password1" value="<?php echo $password1; ?>">
                        <?php echo $company_password1_error; ?>
                    </div>

                    <div class="form-group">
                        

                        <div class="form-group terms">
                            <input type="checkbox" id="terms" name="terms">
                            <label for="terms" class="add-label">
                                I have read and agreed on the
                                <a href="terms.php" target="windowName"
                                    onclick="window.open(this.href,this.target,'width=800,height=500,scrollbars=yes');
                                return false;">TERMS and CONDITIONS
                                </a> of Pinoy Seaman<span style="color: red;">*</span>
                                <?php echo $company_terms_error; ?>
                            </label>
                        </div>

                        

                    <!-- reCAPTCHA -->
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6LcmCKAqAAAAAIemTEJHNXEzWPxh-h3oq_9YH12Y"></div>
                        <?php echo $captcha_error ?? ''; ?>
                    </div>

                    <button class="employer-register" id="Submit" name="Submit" type="Submit">Register Company Now </button>

                </form>
            </div>
        </div>
        <?php include 'includes/aside.php' ?>
    </div>
</body>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="js/validation.js"></script>
<?php include 'includes/footer.php' ?>

<?php
// Server-side CAPTCHA verification
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $secretKey = '6LcmCKAqAAAAAMCPO7v2c-0nooBV_hbvBPjHHAKv';
    $responseKey = $_POST['g-recaptcha-response'];
    $userIP = $_SERVER['REMOTE_ADDR'];
    $verifyURL = "https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$responseKey}&remoteip={$userIP}";

    $response = file_get_contents($verifyURL);
    $responseKeys = json_decode($response, true);

    if (!$responseKeys['success']) {
        $captcha_error = "Please complete the CAPTCHA to proceed.";
    }
}
?>