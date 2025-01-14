<?php
include 'includes/dashboard-header.inc.php';
include 'includes/sidenav.inc.php';
?>
<body>
<main>
    <h1 class="page-title">Update Profile</h1>
    <section class="container">
            <div class="container-controller">
              <div class="card mb-4">
                  <div class="card-header">Seaman Profile</div>
                  <div class="card-body">
                    <form action="#" method="post">
                        <h4 class="profile-header">General Information</h4>
                        <h6 class="name-position">Daniel Pagcaliwangan</h6>

                          <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1">Phone number</label>
                                <input class="form-control" name="cellphone" id="cellphone" type="tel" placeholder="Enter your phone number" value="094-5273-3164">
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Birthday</label>
                                <input class="form-control" placeholder="Enter your birthday" value="06/10/1988">
                            </div>
                          </div>
      
                          <div class="row gx-3 mb-3">
                              <!-- Form Group (gender)-->
                              <div class="col-md-6">
                                  <label class="small mb-1" for="inputOrgName">Gender</label>
                                  <input class="form-control" name="sex" id="sex" type="text" placeholder="bakla">
                              </div>
                              <!-- Form Group (location)-->
                              <div class="col-md-6">
                                  <label class="small mb-1" for="inputLocation">Residence nearest City:</label>
                                  <input class="form-control" name="city" id="city" type="text" placeholder="Enter your location" value="Lipa City">
                              </div>
                          </div>

                        <!--------------------------------------- work experience ---------------------------------------->
                          <hr>
                          <h4 class="profile-header">Sea Going Experience</h4>
                            <textarea  name="seagoing_work" rows="4" placeholder="Enter your Message" id="contact-form-input"></textarea>

                        <!---------------------------------------- passport ---------------------------------------->
                          <hr>
                          <h4 class="profile-header">Passport </h4>
                              <div class="row gx-3 mb-3">
                                <!-- Form Group (country)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Country</label>
                                    <input class="form-control" name="passport_country" type="text">
                                </div>
                                <!-- Form Group (Issued)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputBirthday">Issued</label>
                                    <input class="form-control" name="passport_issued" type="text" >
                                </div>
                              </div>
          
                              <div class="row gx-3 mb-3">
                                  <!-- Form Group (No.)-->
                                  <div class="col-md-6">
                                      <label class="small mb-1" for="inputOrgName">No.</label>
                                      <input class="form-control" name="passport_no" type="text" >
                                  </div>
                                  <!-- Form Group (valid)-->
                                  <div class="col-md-6">
                                      <label class="small mb-1" for="inputLocation">Valid</label>
                                      <input class="form-control" name="passport_valid" type="text">
                                  </div>
                              </div>

                          <!---------------------------------------- seamans book ---------------------------------------->
                          <hr>
                          <h4 class="profile-header">Seaman's Book </h4>
                              <div class="row gx-3 mb-3">
                                <!-- Form Group (country)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Country</label>
                                    <input class="form-control" name="sbook_country" type="tel">
                                </div>
                                <!-- Form Group (Issued)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputBirthday">Issued</label>
                                    <input class="form-control" name="sbook_issued" type="text" name="birthday">
                                </div>
                              </div>
          
                              <div class="row gx-3 mb-3">
                                  <!-- Form Group (No.)-->
                                  <div class="col-md-6">
                                      <label class="small mb-1" for="inputOrgName">No.</label>
                                      <input class="form-control" name="sbook_no" type="text" >
                                  </div>
                                  <!-- Form Group (valid)-->
                                  <div class="col-md-6">
                                      <label class="small mb-1" for="inputLocation">Valid</label>
                                      <input class="form-control" name="sbook_valid" type="text">
                                  </div>
                              </div>
                           <!----------------------------------------------- texbox area ---------------------------------------->
                            <hr>
                            <h4 class="profile-header">License Competency </h4>

                              <textarea name="competence" rows="4" placeholder="Enter your Message" id="contact-form-input"></textarea>

                            <hr>
                            <h4 class="profile-header">Certificate </h4>
                              <textarea name="certificates" rows="4" placeholder="Enter your Message" id="contact-form-input"></textarea>

                            <hr>
                            <h4 class="profile-header">Education and training</h4>
                              <textarea name="educ_training" rows="4" placeholder="Enter your Message" id="contact-form-input"></textarea>

                            <hr>
                            <h4 class="profile-header">Non sea going Work Experience</h4>
                              <textarea name="non_seagoing_work" rows="4" placeholder="Enter your Message" id="contact-form-input"></textarea>

                            <hr>
                            <h4 class="profile-header">Merits Reward</h4>
                              <textarea name="merits" rows="4" placeholder="Enter your Message" id="contact-form-input"></textarea>

                            <hr>
                            <h5 style="color: rgb(55, 54, 54);">Allow manning agency to view profile:</h5>
                            <input type="radio" id="yes" name="yes" value="yes">
                            <label for="yes" class="profile-label">Yes</label><br>
                            <input type="radio" id="no" name="no" value="no">
                            <label for="no" class="profile-label">No</label>
                          
                            <div class="password-form-control">
                              <label class="small mb-1" for="inputOrgName">Current Password</label>
                              <input class="form-control" name="passwrd" type="password" id="passwrd2" placeholder="Enter your Password">
                            </div>

                          <hr>
                          <!-- Save changes button-->
                          <button class="btn btn-primary" type="button">Save changes</button>
                    </form>
                  </div>
                </div>
            </div>
      </section>
  </main>  
  <?php include 'includes/body.inc.php';?>  
</body>
</html>