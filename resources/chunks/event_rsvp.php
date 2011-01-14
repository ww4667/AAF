<form class="form" action="[[~[[*id]]]]" method="post">

    <input name="nospam:blank" type="hidden" />
	 
	<h2>Event & Member Information</h2>
	
	<li>
    	<label>Event <strong>*</strong></label>
		<select name="org_state" class="required">
	        <option value="">--Select An Upcoming Event--</option>
	        <option>October Luncheon : Managing Clients For High Impact</option>
	        <option>September Luncheon : Regional Advertising Doesn't Have to Suck</option>
	        <option>August Luncheon : Things We Learned The Hard Way About Mobile Apps</option>
		</select>
    </li>
	
	<label for="name">Your Name <strong>*</strong></label>
	<p class="error">[[+fi.error.name]]</p>
    <input id="name" name="name:required" type="text" value="[[+fi.name]]" />

	<label for="company">Company/ Organization:</label>
    <input id="company" name="company" type="text" value="[[+fi.company]]" />
	
	<label for="email">Your Email Address <strong>*</strong></label>
	<p class="error">[[+fi.error.email]]</p>
    <input id="email" name="email:required" type="text" value="[[+fi.email]]" />
	
	<label for="phone">Your Phone Number <strong>*</strong></label>
	<p class="error">[[+fi.error.phone]]</p>
    <input id="phone" name="phone:required" type="text" value="[[+fi.phone]]" />
	 
	<li>
    	<label>Membership Status <strong>*</strong></label>
		<select name="mem_status" class="required">
	        <option value="">--Select Your Current Membership Status--</option>
	        <option>Member ($20)</option>
	        <option>Non-Member ($35)</option>
	        <option>Student ($17)</option>
		</select>
    </li>

    <label for="spec_requests">Any Special Requests (i.e. vegetarian meal, etc.)</label>
    <textarea id="spec_requests" cols="55" rows="7" name="spec_requests:stripTags">[[+fi.spec_requests]]</textarea>
	
	<h2>Payment Information</h2>
	
	<div style="margin-bottom:10px">
		<span style="float:left"><img src="resources/images/icn_cards.png" /></span>
		<h5 style="float:left;padding:3px 0 0 5px">Your Information Is Secure</h5>
		<br class="clear" />
	</div>
	
	<label for="card_name">Name On Card <strong>*</strong></label>
	<p class="error">[[+fi.error.card_name]]</p>
    <input id="card_name" name="card_name:required" type="text" value="[[+fi.card_name]]" />
	
	<label for="card_num">Card Number <strong>*</strong></label>
	<p class="error">[[+fi.error.card_num]]</p>
    <input id="card_num" name="card_num:required" type="text" value="[[+fi.card_num]]" />
	
	<li class="cc_info">
		<label>Expiration Date <strong>*</strong><br />
			<span style="float:left">(mm/yy)</span>
		</label>
		
        <select class="ccmonth" id="ccmonth" name="ccmonth">
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
        </select>
        &nbsp;/&nbsp; 
        <select class="" id="ccyear" name="ccyear">
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
        </select>
    </li>

    <br class="clear" />

    <li>
    	<label>&nbsp;</label>
    	<input class="submit_btn" type="image" value="Send Question" src="/resources/images/btn_rsvp.png" alt="Submit RSVP" />
    </li>
	 
</form>