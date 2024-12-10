<?php
$link = mysqli_connect($dbhost, $dbusername, $dbuserpassword, $dbname) 
    or die("Error connecting to the database: " . mysqli_connect_error());

// Fetch job titles and their counts
$query = "SELECT job_title, COUNT(*) AS count 
          FROM jobs 
          GROUP BY job_title 
          ORDER BY job_title ASC";
$result = mysqli_query($link, $query) 
    or die("Error executing query: " . mysqli_error($link));

// Initialize an array to store job titles
$jobs = [];
while ($row = mysqli_fetch_assoc($result)) {
    $jobs[] = [
        'title' => htmlspecialchars($row['job_title']),
        'count' => $row['count']
    ];
}

// Close the database connection
mysqli_close($link);

// Calculate total jobs and split into two columns
$total_jobs = count($jobs);
$half = ceil($total_jobs / 2);

// First column
echo '<div class="column">';
for ($i = 0; $i < $half; $i++) {
    echo '<p>' . $jobs[$i]['title'] . ' (' . $jobs[$i]['count'] . ')</p>';
}
echo '</div>';

// Second column
echo '<div class="column">';
for ($i = $half; $i < $total_jobs; $i++) {
    echo '<p>' . $jobs[$i]['title'] . ' (' . $jobs[$i]['count'] . ')</p>';
}
echo '</div>';
?>
