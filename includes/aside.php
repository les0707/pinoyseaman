<form action="employer_login_verify.php" method="post" autocomplete="off" name="employer" id="employer" onsubmit="return validateForm_employer()">
  <div class="side-content">

        <div class="employer">
          <!--container seaman and employer log in-->
          <div class="category">
            <strong>Employer Login</strong>

            <div class="input-fields">
              <label>Employer ID: </label>
              <input class="side-input" name="employer_id" id="employer_id" type="text">
              <label>Password: </label>
              <input class="side-input" name="employer_password" id="employer_password" type="password">
              <input class="side-button" type="submit" value="Login" name="submit" id="submit">
              <a href="employer_help.php">Forgot Employer ID/Password?</a><br>
              <a href="add_employer.php">Register Now</a>
            </div>
          </div>

        </div>

    </form>

    <form action="seaman_login_verify.php" method="post" name="seaman" id="seaman" onsubmit="return validateForm_seaman()">

      <div class="employer">
        <!--container seaman and employer log in-->
        <div class="category">
          <strong>Seaman Login</strong>
          <div class="input-fields">
            <label>Email: </label>
            <input class="side-input" name="job_seeker_id" id="job_seeker_id" type="text">
            <label>Password: </label>
            <input class="side-input" name="job_seeker_password" id="job_seeker_password" type="password">
            <input class="side-button" type="submit" value="Login" name="submit">
            <a href="seaman_help.php">Forgot your Password?</a><br>
            <a href="add_seaman.php">Register Now</a>
          </div>
        </div>
      </div>
    </form>

    <div class="database">
      <!--container database record-->
      <div class="category">
        <strong>Database Records</strong>
        <?php

        $link = mysqli_connect($dbhost, $dbusername, $dbuserpassword, $dbname)
          or die("Error connecting to the database: " . mysqli_connect_error());

        $query = "SELECT * FROM pinoystats";

        $result = mysqli_query($link, $query) or die("Error executing query: " . mysqli_error($link));

        $row = mysqli_fetch_array($result);
        ?>
        </div>
          <div class="data-record">
            <strong><a href="seaman_list.php">Registered Seaman :</a> </strong> <span><?php echo $row["seaman"]; ?></span>
            <strong><a href="company_list.php">Registered Company: </a> </strong> <span><?php echo $row["employer"]; ?></span><br>
            <strong><a href="job_search.php">Job Posted: </a></strong> <span><?php echo $row["jobs"]; ?></span>
          </div>
    </div>

    <div class="database">
      <!--container new seaman member -->
      <div class="category">
        <strong>Newest Seaman member</strong>
          <?php
          $link = new mysqli($dbhost, $dbusername, $dbuserpassword, $dbname);
          if ($link->connect_error) {
            die("Connection failed: " . $link->connect_error);
          }

          $query = "SELECT first_name, last_name, prefer_job, date FROM job_seeker ORDER BY code DESC LIMIT 1";
          $result = $link->query($query);

          if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = ucwords(strtolower($row["first_name"]) . " " . strtolower($row["last_name"]));
            $position = htmlspecialchars($row["prefer_job"], ENT_QUOTES, 'UTF-8');
            $date_registered = htmlspecialchars($row["date"], ENT_QUOTES, 'UTF-8');
          } else {
            $name = "No data available";
            $position = "No data available";
            $date_registered = "No data available";
          }

          $result->free();
          $link->close();

          ?>
        </div>
          <div class="data-record">
          <strong class="record-style">Name: </strong> <span><?php echo $name; ?></span><br>
          <strong class="record-style">Position: </strong> <span><?php echo $position; ?></span> <br>
          <strong class="record-style">Date Registered: </strong> <span><?php echo $date_registered; ?></span>
          </div>
    </div>

    <div class="random-images">
      <!--container random images-->
      <div class="category">
        <strong>Random Images</strong>
        <div class="image-container">
          <?php
          $folder = 'seaman_pics/';
          $images = glob($folder . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
          if (!empty($images)) {
            $randomImage = $images[array_rand($images)];
          } else {
            $randomImage = 'bbbbbb.jpg';
          }
          ?>
          <img src="<?php echo htmlspecialchars($randomImage); ?>" alt="Random Image">
        </div>
      </div>
    </div>


    <div class="submit-photo">
      <a href="">Submit a photo</a>
    </div>

    <div class="category">
      <strong>Advertisement</strong>
    </div>

    <a class="ads-container" href="https://www.facebook.com/groups/208236972851302/">
      <img src="images/yourads.jpg" alt="">
    </a>

    <a class="ads-container" href="https://www.facebook.com/groups/208236972851302/">
      <img src="images/yourads.jpg" alt="">
    </a>

    <a class="ads-container" href="https://www.facebook.com/groups/208236972851302/">
      <img src="images/yourads.jpg" alt="">
    </a>
    
  </div>
