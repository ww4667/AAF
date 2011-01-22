<? 

$items = $m->viewApplications();


foreach($items as $m){ ?>
    <div class="job_posting_summary">
        <h3><?= $m->first_name ?> <?= $m->last_name ?></h3>
        <p class="posted_on">email: <b><?= $m->email ?> - <?= $m->id ?> - Approved = [ <?= $m->approved ?> ] </b> <a href="/gir/index.php?controller=member_application&method=approve-app&app_id=<?= $m->id ?>">approve</a></p>
        
       
    </div>
<? } ?>
