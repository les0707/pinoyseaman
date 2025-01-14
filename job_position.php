<?php
include 'includes/dashboard-header.inc.php';
include 'includes/sidenav.inc.php';
?>
<body>
<main>
    <h1 class="page-title">Job Position Settings</h1>
    <section class="container">
      <div class="container-controller">
        <div class="card mb-4">
          <div class="card-header">Job Position</div>
            <div class="card-body">
                <form method="post" action="edit_seaman_profile_now.php" name="edit_seaman_profile" id="edit_seaman_profile"  onsubmit="return validateForm_edit_seaman_profile()">
                        
                        <!-- Form Group (Job position)-->
                        <h6 class="name-position">Slot Technician</h6>
                        <hr>
                        <label class="small mb-1">Select new job position: </label><br>
                        <select name="prefer_job" class="prefer-job">
                          <option value="">Job Position: </option>
                          <option value="Rabbi">CLERGY - Rabbi</option>
                          <option value="Reverend">CLERGY - Reverend</option>
                          <option value="Longitude Conveyor Operator">CONSTRUCTION CREW - Longitude Conveyor Operator</option>
                          <option value="Repair Welder /  AWTI ">CONSTRUCTION CREW - Repair Welder /  AWTI </option>
                          <option value="Rigger Foreman">CONSTRUCTION CREW - Rigger Foreman</option>
                          <option value="Spacer">CONSTRUCTION CREW - Spacer</option>
                          <option value="Stalking Machine Operator">CONSTRUCTION CREW - Stalking Machine Operator</option>
                        </select>

                        <!-- Form Group (password)-->
                        <div class="password-form-control">
                          <label class="small mb-1">Password</label>
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