<?php 

    $theEvent = $e->showEventDetail($event); 

?>
<div class="event_posting">
    <h3><?= $theEvent["event_title"] ?></h3>
    <p class="event_poster">Location: <b><?= $theEvent["event_location"] ?></b></p>
    <p class="posted_on">Posted on: <b><?= $theEvent["created_ts"] ?></b></p>
    <p><?= $theEvent["event_details"] ?></p>
</div>