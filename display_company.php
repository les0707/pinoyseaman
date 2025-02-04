<?php
include 'connect.php';
include 'includes/header.php';
include 'includes/nav.php';
?>
<body>
<div class="main-content">
<main class="job-main-content">
        <section class="company-container">  
            <div class="header">
                <div class="company-logo">CAREER</div>
                <div class="company-info">
                    <h1>Career Philippines Shipmanagement, Inc.</h1>
                    <p>15 jobs</p>
                </div>
            </div>

            <div class="section-container">
                <h2 class="company-details">Company Details</h2>
                <p>Company: <span>Scanmar Maritime Services, Inc</span></p>
                <p>Phone: <span>(2)88191013 to 17 local 145 &amp 147 / 0917 915 3969</span></p>
                <p>Address: <span>2227 Royal Enterprise Bldg. Chino Roces Avenue, Makati City</span></p>
                <p>Website: <span>www.scanmar.com.ph</span></p>
                <p>Email: <span>recruitment@scanmar.com.ph</span></p>
            </div>
        </section>

        <section class="company-container">
            <div class="section-container">
                <h2 class="company-details">Job Openings</h2>
        
                <div class="job">
                    <p class="company-job-title">AB / COOK</p>
                    <strong class="company-job-details">Vessel type: </strong>
                    <div class="tags">
                        <span class="tag">Gen</span>
                        <span class="tag">Cargo</span>
                        <span class="tag">Vessel</span>
                    </div>
                    <span class="time">2w ago</span>
                    <button type="button" class="job-button" data-toggle="modal" data-target="#apply-job-modal">Apply Now</button>
                </div>
        
                <div class="job">
                    <p class="company-job-title">Third Engineer</p>
                    <strong class="company-job-details">Vessel type: </strong>
                    <div class="tags">
                        <span class="tag">3rd Officer / 3rd Mate</span>
                        <span class="tag">Container</span>
                        <span class="tag">Gen. Cargo</span>
                        <span class="tag">Heavylift</span>
                    </div>
                    <span class="time">2w ago</span>
                    <button type="button" class="job-button" data-toggle="modal" data-target="#apply-job-modal">Apply Now</button>
                </div>
        
            </div>

        <!------------------ Modal for dashboard ----------------->
        <div class="modal fade" id="apply-job-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Job Posting</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="job-card">
                    <div class="header">
                        <img src="images/wallem_logo.jpg" alt="Company Logo" id="modal-company-logo">
                    </div>
                    <div class="job-details">
                        <h4 class="job-title-modal" id="modal-job-title">Software Developer (Fresh Grads)</h4>
                        <h6 class="mb-0">Vessel Type: </h6>
                        <p class="job-description" id="modal-vessel-type">cargo type</p>
                        <h6 class="mb-0">Job description:</h6>
                        <p class="job-description" id="modal-job-description"> Developers/Programmers (Information &amp; Communication Technology)</p>
                        <h6 class="mb-0">Job requirements:</h6>
                        <p class="job-requirements" id="modal-job-requirements"> Full-time</p>

                        <figcaption class="description">If you want to apply for this job please enter your Pinoyseaman Login Account below.</figcaption>

                        <div class="user-inputs">
                        <label for="email">Email</label>
                        <input name="job_seeker_id" type="email" id="email" class="form-control" placeholder="Enter your email">

                        <label for="password">Password</label>
                        <input name="job_seeker_password" type="password" id="password" class="form-control" placeholder="Enter your password">
                        </div>

                        <figcaption class="register">I dont have Pinoyseaman Account. <a href="add_seaman.php">Register</a></figcaption>
                        <div class="actions">
                        <button type="submit" id="modal-company-code" class="btn btn-primary" name="submit2">Apply now</button>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>
        </section>
    </main>
  <?php include 'includes/aside.php'; 
        include 'includes/body.inc.php';
  ?>
</div>
</body>
<?php include 'includes/footer.php'; ?>