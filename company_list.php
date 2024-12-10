<?php
include 'connect.php';
include 'includes/header.php';
include 'includes/nav.php';

?>

<body>

  <div class="main-content">

    <div class="company-content">

      <div class="company-header-container">
        <strong>Registered Manning Agency</strong>
      </div>
      <div class="hiring-container">
        <div class="company-list">
          <?php include 'includes/fetch_companies.php'; ?> 
        </div>
      </div>

    </div>

    <?php include 'includes/aside.php' ?>

  </div>

</body>
<?php include 'includes/footer.php' ?>