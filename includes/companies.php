<?php
      $link = mysqli_connect($dbhost, $dbusername, $dbuserpassword, $dbname)
        or die("Error connecting to the database: " . mysqli_connect_error());

      $query = "SELECT company_name, company_code, COUNT(*) AS job_count FROM jobs WHERE mark <> '' AND expiry >= '$datenow' GROUP BY company_name, company_code ORDER BY company_name ASC";

      $result = mysqli_query($link, $query) or die("Error executing query: " . mysqli_error($link));

      while ($row = mysqli_fetch_assoc($result)) :
        $company_name = str_replace(["^", "*"], ["'", "&"], $row['company_name']);
        $company_code = $row['company_code'];
        $job_count = (int)$row['job_count'];
      ?>
        <a href="display_company.php?id=<?php echo htmlspecialchars($company_code); ?>">
          <?php echo htmlspecialchars($company_name); ?>
        </a>
        <span class="span-main">(<?php echo $job_count; ?>)</span>
      <?php endwhile; ?>