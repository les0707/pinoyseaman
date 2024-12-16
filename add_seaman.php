<?php
// include 'connect.php';
include 'includes/dbh.inc.php';
include 'includes/header.php';
include 'includes/nav.php';
?>

<body>

  <div class="main-content">

    <div class="company-content">

            <div class="company-header-container"> 
                <strong>Employer Registration (for Manning Agency registration only)</strong>
            </div>

            <div class="add-seaman-banner">
              <img src="images/seaman_pic.jpg" alt="">
            </div>
      
      <div class="seaman-registration-form"> 
                    <h2>Register as Seaman</h2>
                        <hr>
                        <form name="register_seaman" id="register_seaman">
                            <div class="formbold-steps">
                                <ul>
                                    <li class="formbold-step-menu1 active">
                                        <span>1</span>
                                        Sign Up
                                    </li>
                                    <li class="formbold-step-menu2">
                                        <span>2</span>
                                        Passport & Seamans Book
                                    </li>
                                    <li class="formbold-step-menu3">
                                        <span>3</span>
                                        Finish Set-up                                    
                                    </li>
                                </ul>
                            </div>
                  
                            <!------------------------------ STEP ONE --------------------------->
                            <div class="formbold-form-step-1 active">

                                <div class="custom-select">
                                    <select name="prefer_job" id="prefer_job" class="formbold-form-input">
                                        <option value="">Select your desired Job Position: </option>
                                        <option value="Rabbi">CLERGY - Rabbi</option>
                                        <option value="Reverend">CLERGY - Reverend</option>
                                        <option value="Longitude Conveyor Operator">CONSTRUCTION CREW - Longitude Conveyor Operator</option>
                                        <option value="Repair Welder /  AWTI ">CONSTRUCTION CREW - Repair Welder /  AWTI </option>
                                        <option value="Rigger Foreman">CONSTRUCTION CREW - Rigger Foreman</option>
                                        <option value="Spacer">CONSTRUCTION CREW - Spacer</option>
                                        <option value="Stalking Machine Operator">CONSTRUCTION CREW - Stalking Machine Operator</option>
                                        <option value="Tension Machine Operator">CONSTRUCTION CREW - Tension Machine Operator</option>
                                        <option value="Assistant">CREWING - Assistant</option>
                                        <option value="Contractual for Visa Processing">CREWING - Contractual for Visa Processing</option>
                                        <option value="Crew Manager">CREWING - Crew Manager</option>
                                        <option value="Crewing Assistant">CREWING - Crewing Assistant</option>
                                        <option value="Crewing Support Assistant">CREWING - Crewing Support Assistant</option>
                                        <option value="Liaison and Documentation Officer">CREWING - Liaison and Documentation Officer</option>
                                        <option value="Sr. Crewing Officer">CREWING - Sr. Crewing Officer</option>
                                        <option value="Sr. Crewing Officer - Cement Fleet">CREWING - Sr. Crewing Officer - Cement Fleet</option>
                                        <option value="Administrative Assistant">CRUISE STAFF - Administrative Assistant</option>
                                        <option value="Aerobics Instructor">CRUISE STAFF - Aerobics Instructor</option>
                                        <option value="Assistant Cruise Director">CRUISE STAFF - Assistant Cruise Director</option>
                                        <option value="Cruise Director">CRUISE STAFF - Cruise Director</option>
                                        <option value="Cruise Staff">CRUISE STAFF - Cruise Staff</option>
                                        <option value="Fitness Instructor">CRUISE STAFF - Fitness Instructor</option>
                                        <option value="Gentlemen Dance Host">CRUISE STAFF - Gentlemen Dance Host</option>
                                        <option value="International Host Hostess">CRUISE STAFF - International Host Hostess</option>
                                    </select>
                                  </div>

                            <div class="formbold-input-flex">
                                <div>
                                    <label for="firstname" class="formbold-form-label"> First name </label>
                                    <input name="first_name" type="text" id="first_name" class="formbold-form-input" placeholder="Juan">
                                </div>
                                <div>
                                    <label for="lastname" class="formbold-form-label"> Middle name </label>
                                    <input name="middle_name" type="text" id="middle_name" class="formbold-form-input" placeholder="Dela">
                                </div>

                                <div>
                                    <label for="lastname" class="formbold-form-label"> Last name </label>
                                    <input name="last_name" type="text" id="last_name" class="formbold-form-input" placeholder="Cruz">
                                </div>
                            </div>
                      
                            <div class="formbold-input-flex">
                                <div>
                                    <small id="dob-error" style="color: red; display: none;">The birth year must only be 4 digits.</small>
                                    <label for="dob" class="formbold-form-label"> Date of Birth </label>
                                    <input type="date" name="date" id="date" class="formbold-form-input">
                                </div>
    
                                <div>
                                    <label for="lastname" class="formbold-form-label"> Gender </label>
                                    <select name="sex" id="sex" class="formbold-form-input">
                                    <option value="">-Select Gender-</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Diverse">Diverse</option>
                                    </select>
                                </div>
    
                                <div>
                                    <label for="email" class="formbold-form-label"> Email Address </label>
                                    <input name="email" type="text" id="email" placeholder="example@mail.com" class="formbold-form-input">
                                </div>

                                <div>
                                    <label for="cellphone" class="formbold-form-label"> Phone </label>
                                    <input name="cellphone" type="text" id="cellphone" class="formbold-form-input" placeholder="11 digits">
                                </div>

                            </div>

                                <div>
                                    <label for="address" class="formbold-form-label"> Address </label>
                                    <input name="city" type="text" id="city" placeholder="Dian street, Makati City." class="formbold-form-input">
                                </div>

                                <div>
                                    <label for="address" class="formbold-form-label"> Re-type Email Address </label>
                                    <input name="email2" type="email" id="email2" placeholder="This will serve as your pinoyseaman login email" class="formbold-form-input">
                                </div>

                        </div>
                  
                          <!------------------------------ STEP TWO --------------------------->
                        <div class="formbold-form-step-2">

                            <h2>Passport Information</h2>

                            <div>
                                <label for="address" class="formbold-form-label"> Country: </label>
                                <input name="passport_country" type="text" id="passport_country" placeholder="ex: Philippines" class="formbold-form-input">
                            </div>
  
                            <div>
                                <label for="address" class="formbold-form-label"> No: </label>
                                <input name="passport_no" type="text" id="passport_no" placeholder="Passport ID" class="formbold-form-input">
                            </div>

                            <div>
                                <label for="address" class="formbold-form-label"> Issued: </label>
                                <input name="passport_issued" type="text" id="passport_issued" placeholder="Date and year issued" class="formbold-form-input">
                                
                            </div>

                            <div>
                                <label for="address" class="formbold-form-label"> Valid: </label>
                                <input name="passport_valid" type="text" id="passport_valid" placeholder="Valid until" class="formbold-form-input">
                            </div>

                            <br>
                            <hr>
                            <br>
                          <h2>Seaman's Book Information</h2>

                            <div>
                                <label for="address" class="formbold-form-label"> Country: </label>
                                <input name="sbook_country" type="text" id="sbook_country" placeholder="ex: Philippines" class="formbold-form-input">
                            </div>

                            <div>
                                <label for="address" class="formbold-form-label"> No: </label>
                                <input name="sbook_no" type="text" id="sbook_no" placeholder="Seaman's Book ID" class="formbold-form-input">
                            </div>

                            <div>
                                <label for="address" class="formbold-form-label"> Issued: </label>
                                <input name="sbook_issued" type="text" id="sbook_issued" placeholder="Date and year issued" class="formbold-form-input">
                            </div>

                            <div>
                                <label for="address" class="formbold-form-label"> Valid: </label>
                                <input name="sbook_valid" type="text" id="sbook_valid" placeholder="Valid until" class="formbold-form-input">
                            </div>

                        </div>
                  
                           <!------------------------------ STEP THREE --------------------------->
                            <div class="formbold-form-step-3">
                                <div class="formbold-form-confirm">
                                    <div>
                                        <label for="message" class="form-sample-label"> Details of your past and present Seagoing Work Experiences:</label>
                                        <p class="sample-format">Sample Format : <br>
                                            Manning Agency : PinoySeaman Shipping <br>
                                            Name of Vessel : M/V <br> 
                                            Majestic Vessel Type : General Cargo<br>
                                            GRT : 32,777 <br>
                                            Rank : A/B <br>
                                            Sign On : Sept. 19, 2023<br>
                                            Sign Off : March 19, 2024"</p>
                                        <textarea
                                          name="seagoing_work"
                                          id="seagoing_work"
                                          rows="4"
                                          class="formbold-form-input"
                                        ></textarea>
                                    </div>
                                </div>

                                <div class="formbold-form-confirm">
                                    <div>
                                        <label for="message" class="form-sample-label">Details of your Non-Seagoing Work Experiences:</label>
                                        <p class="sample-format">Sample Format : <br>
                                            Company : Jollibee <br>
                                            Position : Service Crew<br> 
                                            From : Sept. 19, 2022<br>
                                            To : Sept. 19, 2023
                                        </p>
                                        <textarea
                                          name="non_seagoing_work" 
                                          id="non_seagoing_work"
                                          rows="4"
                                          class="formbold-form-input"
                                        ></textarea>
                                      </div>
                                </div>

                                <div class="formbold-form-confirm">
                                    <div>
                                        <label for="message" class="form-sample-label">Education and Training:</label>
                                        <textarea
                                          name="educ_training" 
                                          id="educ_training"
                                          rows="4"
                                          class="formbold-form-input"
                                        ></textarea>
                                    </div>
                                </div>

                                <div class="formbold-form-confirm">
                                    <div>
                                        <label for="message" class="form-sample-label">Merits, Rewards, Titles, Hobbies, Interest:</label>
                                        <textarea
                                          name="merits"
                                          id="merits"
                                          rows="4"
                                          class="formbold-form-input"
                                        ></textarea>
                                    </div>
                                </div>

                                <div class="formbold-form-confirm">
                                    <div class="formbold-form-file-flex">
                                        <label for="upload" class="formbold-form-label">
                                            Upload your License, Competency, U.S. Visa, Schengen Visa:
                                        </label>
                                        <input type="file" name="competence" id="competence" class="formbold-form-file"/>
                                    </div>
                                </div>

                                <div class="formbold-form-confirm">
                                    <div class="formbold-form-file-flex">
                                        <label for="upload" class="formbold-form-label">
                                            Upload your Certificates :
                                        </label>
                                        <input type="file" name="certificates" id="certificates" class="formbold-form-file"/>
                                    </div>
                                </div>

                                <div class="form-group terms">
                                    <input type="checkbox" id="view" name="view" >
                                    <label for="terms" class="add-label">
                                        Allow Employer to view my profile and include me on manual job search.
                                    </label>
                                    <br>
                                    <br>
                                    <input type="checkbox" id="ab" name="ab" >
                                    <label for="terms" class="add-label">
                                        I have read and agreed on the <a href="#">TERMS and CONDITIONS</a> of PinoySeaman.com 
                                    </label>
                                </div>
                            </div>
                            <div class="formbold-form-btn-wrapper">
                              <button class="formbold-back-btn">
                                Back
                                </button>
                    
                              <button class="formbold-btn" id="next-button">
                                Next Step
                              </button>

                              <button type="submit" id="submit-button" class="formbold-btn">Submit</button>
                            </div>

                        </form>
                </div>
    </div>
    <?php include 'includes/aside.php' ?>
  </div>
</body>
<?php include 'includes/footer.php' ?>