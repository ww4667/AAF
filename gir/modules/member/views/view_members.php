<? 

$items = $m->viewMembers();


foreach($items as $m){ 
?>
    <div class="job_posting_summary">
        <h3><?= $m->first_name ?> <?= $m->last_name ?></h3>
        <p class="posted_on">company: <b><?= $m->company ?> - <?= $m->id ?> </b></p>
        
       
    </div>
<? } ?>
