<?php
include 'includes/dashboard-header.inc.php';
include 'includes/sidenav.inc.php';
?>
<body>
    <main>
        <h1 style="text-align: center;">Message to your employer</h1>
        <section class="job-container">
        <div class="contact-job-card">
            <div class="contact-desc">
            <h6 class="secondary-text">Name:</h6>
                <h6 class="contact-primary-text">Daniel Pagcaliwangan</h6>
                <h6 class="secondary-text">Email:</h6>
                <h5 class="contact-primary-text">pagcaliwangan11@gmail.com</h5>
                <h6 class="secondary-text">Send Message to Employer:</h6>
                <textarea name="message" rows="4" placeholder="Enter your Message" id="contact-form-input"></textarea>
            </div>
            <div class="details">
            <div class="button-container">
                <button type="submit" class="btn-submit">Submit</button>
                <button type="reset" class="btn-reset">Reset</button>
            </div>
            </div>
        </div>
        </section>
    </main>
    <?php include 'includes/body.inc.php';?>
</body>
</html>