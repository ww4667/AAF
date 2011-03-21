<form action="" method = "post" class = "form"id="update_event_form" >
<ol>
          <li>
          <label>Event Title</label>
          <input type = "text" class = "required"  name = "event_title" value = "<?= $theEvent->event_title?>" />
          </li>
                    <li>
          <label>Event Location</label>

          <input type = "text" class = "required"  name = "event_location"value = "<?= $theEvent->event_location?>" />
          </li>
                    <li><label>Event Details</label>
          <textarea cols="55" class = "required" rows="7" name="event_details"><?= $theEvent->event_details ?></textarea>
          </li>
                    <li>
          <label>Event Start Date</label>

          <input type = "text" class = "required"  name = "event_start_date" value = "<?= $theEvent->event_start_date?>" />
          </li>
                    <li>
          <label>Event Start Time</label>
          <input type = "text" class = "required"  name = "event_start_time" value = "<?= $theEvent->event_start_time?>" />
          </li>
                    <li>
          <label>Event End Date</label>

          <input type = "text" class = "required"  name = "event_end_date" value = "<?= $theEvent->event_end_date?>" />
          </li>
                    <li>
          <label>Event End Time</label>
          <input type = "text" class = "required"  name = "event_end_time" value = "<?= $theEvent->event_end_time?>" />
          </li>
                    <li>
          <label>Full Name</label>

          <input type = "text" class = "required"  name = "name" value = "<?= $theEvent->name?>" />
          </li>
                    <li>
          <label>Your Email</label>
          <input type = "text" class = "required"  name = "email" value = "<?= $theEvent->email?>" />
          </li>
                    <li>
          <label>Your Phone Number</label>

          <input type = "text" class = "required"  name = "phone_number" value = "<?= $theEvent->phone_number?>" />
          </li>
               <li>
        <label>&nbsp;</label>
        <input type="hidden" name = "event_id" value = "<?= $event_id ?>" />
        <input type="hidden" name="google_calendar_id" value = "<?= $theEvent->google_calendar_id?>" />
        <input class="submit_btn" type="image" value="Send Question" src="/resources/images/submit.png" alt="Submit Job" />
     </li>
</ol>
</form>

<script type="text/javascript">
    $(document).ready(function() { 
        //$("#submit_job_form").validate();
    });
</script>