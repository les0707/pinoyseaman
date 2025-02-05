<?php
include 'connect.php';
include "includes/dbh.inc.php";
include 'includes/header.php';
include 'includes/nav.php';

// Sanitize input
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

if (!$id) {
    die("Invalid company ID.");
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<body>
<div class="main-content">
<main class="job-main-content">
        <section class="company-container">  
        <?php
            try {
                // Fetch company details
                $stmt = $pdo->prepare("SELECT * FROM employer WHERE company_code = :id");
                $stmt->execute(['id' => $id]);

                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $expiry = $row["date"];
                        ?>
                        <div class="header">
                            <div class="company-logo"><img src="logo/<?php echo htmlspecialchars($row['logo']); ?>" alt="Company Logo"></div>
                            <div class="company-info">
                                <h1><?php echo htmlspecialchars($row['company']); ?></h1>
                                <p>15 jobs</p>
                            </div>
                        </div>

                        <div class="section-container">
                            <h2 class="company-details">Company Details</h2>
                            <p>Company: <span><?php echo htmlspecialchars($row['company']); ?></span></p>
                            <p>Profile: <span><?php echo htmlspecialchars($row['company_profile']); ?></span></p>
                            <p>Phone: <span><?php echo htmlspecialchars($row['phone']); ?></span></p>
                            <p>Address: <span><?php echo nl2br(htmlspecialchars($row['address'])); ?></span></p>
                            <p>Website: <span><a href="http://<?php echo htmlspecialchars($row['website']); ?>" target="_blank">
                                        <?php echo htmlspecialchars($row['website']); ?>
                                    </a></span></p>
                            <p>Email: <span><?php echo htmlspecialchars($row['email']); ?></span></p>
                        </div>
                        <?php
                    }
                } else {
                    echo "No company details found.";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        ?>
            

            
        </section>

        <section class="company-container">
            <div class="section-container">
                <h2 class="company-details">Job Openings</h2>

                <?php
                    try {
                        // Fetch job listings
                        $stmt = $pdo->prepare("SELECT job_title, vessel, company_code, job_description, requirements FROM jobs WHERE company_code = :id AND mark = 'y' AND expiry >= :datenow ORDER BY job_title ASC");
                        $stmt->execute(['id' => $id, 'datenow' => date('Y-m-d')]);

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <div class="job">
                                <input type="hidden" value="<?php echo urlencode($id); ?>"></input>
                                <input type="hidden" value="<?php echo urlencode($row['job_title']); ?>"></input>
                                <p class="company-job-title"><?php echo htmlspecialchars($row['job_title']); ?></p>
                                <strong class="company-job-details">Vessel type:</strong>
                                <div class="tags">
                                    <span class="tag"><?php echo htmlspecialchars($row['vessel']); ?></span>
                                </div>
                                <button type="button" 
                                    class="job-button" 
                                    data-toggle="modal" 
                                    data-target="#apply-job-modal"
                                    data-title="<?php echo htmlspecialchars($row['job_title']); ?>"
                                    data-id="<?php echo urlencode($id); ?>"
                                    data-vessel="<?php echo htmlspecialchars($row['vessel']); ?>"
                                    data-company-code="<?php echo htmlspecialchars($row['company_code']); ?>"
                                    data-description="<?php echo htmlspecialchars($row['job_description']); ?>"
                                    data-requirements="<?php echo htmlspecialchars($row['requirements']); ?>">
                                    Apply Now
                                </button>
                            </div>
                            
                            <?php
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                ?>
        
            </div>

        <!------------------ Modal for dashboard ----------------->
        <div class="modal fade" id="apply-job-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <img src="" alt="Company Logo" id="modal-company-logo">
                            </div>
                            <form action="includes/apply_for_this_job_verify.inc.php" method="post">
                                <div class="job-details">
                                    <h4 class="job-title-modal" id="modal-job-title"></h4>
                                    <h6 class="mb-0">Vessel Type:</h6>
                                    <p class="job-description" id="modal-vessel-type"></p>
                                    <figcaption class="description">If you want to apply for this job, please enter your PinoySeaman login account below.</figcaption>
                                    <div class="user-inputs">
                                        <label for="email">Email</label>
                                        <input name="job_seeker_id" type="email" id="email" class="form-control" placeholder="Enter your email">
                                        <label for="password">Password</label>
                                        <input name="job_seeker_password" type="password" id="password" class="form-control" placeholder="Enter your password">
                                    </div>
                                    <figcaption class="register">I don’t have a PinoySeaman account. <a href="add_seaman.php">Register</a></figcaption>
                                    <div class="actions">
                                        <input name="company_code" type="hidden" id="modal-company-code">
                                        <input name="code" type="hidden" id="modal-job-code">
                                        <button type="submit" class="btn btn-primary" name="submit2">Apply now</button>
                                    </div>
                                </div>
                            </form>
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
  <?php include 'includes/aside.php'; 
        include 'includes/body.inc.php';
  ?>
</div>
</body>
<?php include 'includes/footer.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    $('#apply-job-modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var jobTitle = button.data('title'); 
        var vesselType = button.data('vessel');
        var companyCode = button.data('company-code');
        var jobDescription = button.data('description');
        var jobRequirements = button.data('requirements');
        var jobCode = button.data('id');

        // Update the modal content
        $('#modal-job-title').text(jobTitle);
        $('#modal-vessel-type').text(vesselType);
        $('#modal-company-code').val(companyCode);
        $('#modal-job-code').val(jobCode);
        $('#modal-job-description').text(jobDescription);
        $('#modal-job-requirements').text(jobRequirements);
    });
});

</script>
