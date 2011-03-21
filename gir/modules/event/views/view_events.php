<? 

$items = $e->showApprovedEvents();

foreach($items as $e){ ?>
    <div class="event_posting_summary">
        <h3><a href="/events/event-details.html?event=<?= $e->id ?>"><?= $e->event_title ?></a></h3>
        <p class="event_poster">Location: <b><?= $e->event_location ?></b></p>
        <p class="posted_on">Event Date(s)<b><?= $e->event_start_date ?></b></p>
        <p><?= substr($e->event_details,0,200) ?> - <?= $e->id ?>
        [<a href="/gir/index.php?controller=event&method=event-details&event=<?= $e->id ?>">read more</a>]</p>
    </div>
<? } ?>

<p style="float:right"><a href="/events/submit-a-event.html" title="Submit A Event">Need to post up a event?</a></p>    