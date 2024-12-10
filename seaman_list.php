<?php
include 'connect.php';
include 'includes/header.php';
include 'includes/nav.php';

?>

<body>

  <div class="main-content">

    <div class="company-content">

      <div class="company-header-container">
        <strong>Registered Seaman Statistics</strong>
      </div>
      <div class="hiring-container">
        <div class="company-list">
            <?php include 'includes/job_list.php'; ?> 
        </div>
      </div>

    </div>

    <?php include 'includes/aside.php' ?>

  </div>

</body>
<?php include 'includes/footer.php' ?>