<?php
include 'connect.php';
include 'includes/header.php';
include 'includes/nav.php';
?>

<body>

  <div class="main-content">
    <div class="company-content">

        <div class="company-header-container"> 
            <strong>Contact Us</strong>
        </div>

        <div class="seaman-registration-form"> 
                <h2>Send Message to pinoyseaman.com</h2>
                    <hr>
    <!------------------------------ form --------------------------->
          <form action="message_verify.php" method="post">
              <div class="formbold-form-step-1 active">
                <div class="formbold-input-flex">
                    <div>
                        <label for="firstname" class="formbold-form-label"> Name </label>
                        <input type="text" name="name" id="name" class="formbold-form-input" placeholder="Juan Dela Cruz">
                    </div>
                    <div>
                        <label for="lastname" class="formbold-form-label"> Your Email </label>
                        <input type="email" name="email" id="email"class="formbold-form-input" placeholder="example@gmail.com">
                    </div>

                    <div>
                        <label for="lastname" class="formbold-form-label"> Contact Number </label>
                        <input type="text" name="contact" id="contact" class="formbold-form-input">
                    </div>
                </div>
          
                    <div class="formbold-form-confirm">
                          <div>
                            <label for="message" class="form-sample-label">Message</label>
                            <textarea
                            name="message"
                            id="message"
                            rows="4"
                            class="formbold-form-input"
                            placeholder="Thank you pinoyseaman!"
                            ></textarea>
                        </div>
                    </div>
                </div>
                <div class="btn-form">
                    <input class="contact-submit" type="submit" value="Submit" name="Submit">
                </div>
          </form>
    </div>

</div>

    <?php include 'includes/aside.php' ?>

  </div>

</body>
<?php include 'includes/footer.php' ?>