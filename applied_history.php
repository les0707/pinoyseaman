<?php
include 'includes/dashboard-header.inc.php';
include 'includes/sidenav.inc.php';
?>
<body>
<main>
    <h1 class="page-title">Applied History</h1>
    <section class="container">
      <!-- First Card -->
      <div class="card" style="width: 15rem;" id="card">
        <img src="ads/yourads2.jpg" class="card-img-top" alt="yourads2">
        <div class="card-body-job">
          <h6 class="company-name">company name</h6>
          <h5 class="job-title">job type</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#applied-history-modal">Info</button>
        </div>
      </div>
  
      <!-- Second Card -->
      <div class="card" style="width: 15rem;" id="card">
      <img src="ads/yourads2.jpg" class="card-img-top" alt="yourads2">
        <div class="card-body-job">
          <h6 class="company-name">company name</h6>
          <h5 class="job-title">job type</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#applied-history-modal">Info</button>
        </div>
      </div>
  
      <!-- Third Card -->
      <div class="card" style="width: 15rem;" id="card">
        <img src="ads/yourads2.jpg" class="card-img-top" alt="yourads2">
        <div class="card-body-job">
          <h6 class="company-name">company name</h6>
          <h5 class="job-title">job type</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#applied-history-modal">Info</button>
        </div>
      </div>
  
      <!-- Fourth Card -->
      <div class="card" style="width: 15rem;" id="card">
      <img src="ads/yourads2.jpg" class="card-img-top" alt="yourads2">
        <div class="card-body-job">
          <h6 class="company-name">company name</h6>
          <h5 class="job-title">job type</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#applied-history-modal">Info</button>
        </div>
      </div>
      
      
      <!------------------ Modal for Applied History ----------------->
      <div class="modal fade" id="applied-history-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <img src="images/wallem_logo.jpg" alt="Company Logo">
                    <h1>Pacific Ocean Manning, Inc.</h1>
                  </div>
                  <div class="job-details">
                    <h4 class="job-title-modal">Software Developer (Fresh Grads)</h4>
                    <h6 class="mb-0">Vessel Type: </h6>
                    <p class="job-description">cargo type</p>
                    <h6 class="mb-0">Job description:</h6>
                    <p class="job-description"> Developers/Programmers (Information &amp; Communication Technology)</p>
                    <h6 class="mb-0">Job reqiurements:</h6>
                    <p class="job-requirements"> Full-time</p>

                    <div class="actions">
                      <button class="btn btn-primary">Cancel</button>
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
  <?php include 'includes/body.inc.php';?>
</body>
</html>