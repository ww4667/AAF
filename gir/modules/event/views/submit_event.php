<form action="" method = "post" class = "form"id="submit_event_form" >
<ol>
          <li>
          <label>Event Title</label>
          <input type = "text" class = "required"  name = "event_title"/>
          </li>
                    <li>
          <label>Event Location</label>

          <input type = "text" class = "required"  name = "event_location"/>
          </li>
                    <li>
          <label>Event Date (or range)</label>

          <input type = "text" class = "required"  name = "event_date"/>
          </li>
          <li><label>Event Details</label>
          <textarea cols="55" class = "required" rows="7" name="event_details"></textarea>
          </li>
          <li>  <p>Please let us know how we can contact you if we have questions about your event:</p></li>
          <li>
          <label>Full Name</label>

          <input type = "text" class = "required"  name = "name"/>
          </li>
                    <li>
          <label>Your Email</label>
          <input type = "text" class = "required"  name = "email"/>
          </li>
                    <li>
          <label>Your Phone Number</label>

          <input type = "text" class = "required"  name = "phone_number"/>
          </li>
               <li>
        <label>&nbsp;</label>
        <input class="submit_btn" type="image" value="Send Event" src="/resources/images/btn_submit.png" alt="Submit Event" />
     </li>
</ol>
</form>

<script type="text/javascript">
    $(document).ready(function() { 
        $("#submit_event_form").validate();
    });
</script>