<?php 

    $theJob = $j->showjobDetail($job); 

?>
<div class="job_posting">
    <h3><?= $theJob["job_title"] ?></h3>
    <p class="job_poster">Company: <b><?= $theJob["company"] ?></b></p>
    <p class="posted_on">Posted on: <b><?= $theJob["created_ts"] ?></b></p>
    <p><?= $theJob["description"] ?></p>
</div>