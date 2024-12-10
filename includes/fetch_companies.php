<?php
$link = mysqli_connect($dbhost, $dbusername, $dbuserpassword, $dbname) 
or die("Error connecting to the database: " . mysqli_connect_error());

// Fetch company data
$query = "SELECT company, id 
      FROM employer 
      ORDER BY company ASC";

$result = mysqli_query($link, $query) or die("Error executing query: " . mysqli_error($link));

// Initialize an array to store company names
$companies = [];
while ($row = mysqli_fetch_assoc($result)) {
$companies[] = [
    'name' => htmlspecialchars($row['company']),
    'id' => urlencode($row['id'])
];
}

// Close the database connection
mysqli_close($link);

// Output the HTML for the company list
$total_companies = count($companies);
$half = ceil($total_companies / 2);

// First column
echo '<div class="column">';
for ($i = 0; $i < $half; $i++) {
echo '<a href="https://www.pinoyseaman.com/display_company3.php?id=' . $companies[$i]['id'] . '">' . $companies[$i]['name'] . '</a>';
}
echo '</div>';

// Second column
echo '<div class="column">';
for ($i = $half; $i < $total_companies; $i++) {
echo '<a href="https://www.pinoyseaman.com/display_company3.php?id=' . $companies[$i]['id'] . '">' . $companies[$i]['name'] . '</a>';
}
echo '</div>';
?>