<p>To suggest an event for our calendar, fill out the form below. Events must be related to the advertising/marketing/communications professions in the central Iowa area.</p>

<form class="form" action="[[~[[*id]]]]" method="post">

    <input name="nospam:blank" type="hidden" />
	
	<label for="event_title">Event Title <strong>*</strong></label>
	<p class="error">[[+fi.error.event_title]]</p>
	<input id="event_title" name="event_title:required" type="text" value="[[+fi.event_title]]" />
	
	<label for="event_location">Event Location <strong>*</strong></label>
	<p class="error">[[+fi.error.event_location]]</p>
	<input id="event_location" name="event_location:required" type="text" value="[[+fi.event_location]]" />
	
	<label for="event_date">Event Date (or range) <strong>*</strong></label>
	<p class="error">[[+fi.error.event_date]]</p>
	<input id="event_date" name="event_date:required" type="text" value="[[+fi.event_date]]" />
	
	<label for="event_details">Event Details</label>
	<textarea id="event_details" cols="55" rows="7" name="event_details:stripTags">[[+fi.event_details]]</textarea>
	
	<p>Please let us know how we can contact you if we have questions about your event:</p>
	
	<label for="name">Your Name <strong>*</strong></label>
	<p class="error">[[+fi.error.name]]</p>
	<input id="name" name="name:required" type="text" value="[[+fi.name]]" />
	
	<label for="email">Your Email Address <strong>*</strong></label>
	<p class="error">[[+fi.error.email]]</p>
	<input id="email" name="email:required" type="text" value="[[+fi.email]]" />
	
	<label for="phone">Your Phone Number <strong>*</strong></label>
	<p class="error">[[+fi.error.phone]]</p>
	<input id="phone" name="phone:required" type="text" value="[[+fi.phone]]" />
	
	<br class="clear" />
	
	<li>
		<label>&nbsp;</label>
		<input class="submit_btn" type="image" value="Submit Event Suggestion" src="/resources/images/btn_submit.png" alt="Submit Event Suggestion" />
	</li>
	
</form>