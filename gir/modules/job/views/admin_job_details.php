<?php 

    $theJob = $j->showjobDetail($job); 

?>
<div class="job_posting">
    <h3><?= $theJob["job_title"] ?></h3>
    <p class="job_poster">Company: <b><?= $theJob["company"] ?></b></p>
    <p class="posted_on">Posted on: <b><?= $theJob["created_ts"] ?></b></p>
    <p class="posted_on">Name: <b><?= $theJob["name"] ?></b></p>
    <p class="posted_on">Phone Number: <b><?= $theJob["phone_number"] ?></b></p>
    <p class="posted_on">Email: <b><?= $theJob["email"] ?></b></p>
    <p class="posted_on">Post job until: <b><?= $theJob["post_job_until"] ?></b></p>
    <p>Description: <?= $theJob["description"] ?></p>
    <p>
        <a href="/gir/index.php?controller=job&method=approve-job&job_id=<?= $theJob["id"] ?>">approve</a> / <a href="/gir/index.php?controller=jobs&method=approve-job&job=true&job_id=<?= $theJob["id"] ?>">deny</a>
    </p>
</div>