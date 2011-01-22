<? 

$items = $j->showApprovedJobs();

foreach($items as $j){ ?>
    <div class="job_posting_summary">
        <h3><a href="/jobs/job-details.html?job=<?= $j->id ?>"><?= $j->job_title ?></a></h3>
        <p class="job_poster">Company: <b><?= $j->company ?></b></p>
        <p class="posted_on">Posted on: <b><?= $j->created_ts ?></b></p>
        <p><?= substr($j->description,0,200) ?>
        [<a href="/jobs/job-details.html?job=<?= $j->id ?>">read more</a>]</p>
    </div>
<? } ?>

<p style="float:right"><a href="/jobs/submit-a-job.html" title="Submit A Job">Need to post up a job?</a></p>