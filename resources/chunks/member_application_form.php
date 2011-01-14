<h2>Your Information</h2>

<form id="member_apply" class="form" action="" method="post" accept-charset="utf-8">
	<ol>
	    <li>
	    	<label><strong>*</strong> Your full name:</label>
			<input name="name" type="text" class="required" />
	    </li>
	    <li>
	    	<label><strong>*</strong> Email:</label>
			<input name="email" type="text" class="email required" />
	    </li>
	    <li>
	    	<label><strong>*</strong> Your job title:</label>
			<input name="job_title" type="text" class="required" />
	    </li>
	    <li>
	    	<label><strong>*</strong> Organization you work for:</label>
			<input name="org_name" type="text" class="required" />
	    </li>
	    <li>
	    	<label><strong>*</strong> Organization address:</label>
			<input name="org_address" type="text" class="required" />
	    </li>
	    <li>
	    	<label><strong>*</strong> Organization city:</label>
			<input name="org_city" type="text" class="required" />
	    </li>
	    <li>
	    	<label><strong>*</strong> Organization state:</label>
			<select name="org_state" class="required">
		        <option value="">--Select a State--</option>
		        <option>Iowa</option>
		        <option>Nebraska</option>
		        <option>Minnesota</option>
			</select>
	    </li>
	    <li>
	    	<label><strong>*</strong> Organization zip code:</label>
			<input name="org_zip" type="text" class="required" />
	    </li>
	    <li>
	    	<label><strong>*</strong> Job description that qualifies you for membership in AAF:</label>
			<input name="job_description" type="text" class="required" />
	    </li>
	    <li>
	    	<label><strong>*</strong> Your Phone:</label>
			<input name="phone" type="text" class="required" />
	    </li>
	    <li>
	    	<label>Your Fax:</label>
			<input name="fax" type="text" />
	    </li>
	    <li>
	    	<label>Referred by:</label>
			<input name="referred_by" type="text" />
	    </li>
	    <li>
	    	<label>Member since:</label>
			<input name="member_since" type="text" />
	    </li>
	    <li>
	    	<label>How did you hear about AAF?</label>
			<textarea name="hear_about"></textarea>
	    </li>
	    <li class="form_stack">
	    	<label><strong>*</strong> Membership classification:</label>
			<ol>
				<li><input type="radio" name="classification" value="Active ($100)" class="required radio_check" /><label class="radio_check">Active ($100)</label></li>
				<li><input type="radio" name="classification" value="Associate ($100)" class="radio_check" /><label class="radio_check">Associate ($100)</label></li>
				<li><input type="radio" name="classification" value="Non-Resident ($35)" class="radio_check" /><label class="radio_check">Non-Resident ($35)</label></li>
				<li><input type="radio" name="classification" value="Student ($35)" class="radio_check" /><label class="radio_check">Student ($35)</label></li>
				<li><input type="radio" name="classification" value="Retired ($20)" class="radio_check" /><label class="radio_check">Retired ($20)</label></li>
				<li><input type="radio" name="classification" value="Corporate ($360 for 4 people)" class="radio_check" /><label class="radio_check">Corporate ($360 for 4 people)</label></li>
				<li><input type="radio" name="classification" value="Corporate ($850 for 10 people)" class="radio_check" /><label class="radio_check">Corporate ($850 for 10 people)</label></li>
				<li><input type="radio" name="classification" value="Corporate ($85 for each additional person)" class="radio_check" /><label class="radio_check">Corporate ($85 for each additional person)</label></li>
				<li><input type="radio" name="classification" value="Professional Full-Time Educator ($75)" class="radio_check" /><label class="radio_check">Professional Full-Time Educator ($75)</label></li>
				<li><input type="radio" name="classification" value="New Graduate Professional ($75)" class="radio_check" /><label class="radio_check">New Graduate (first year out of school) Professional ($75)</label></li>
			</ol>
	    </li>
	    <li class="form_stack">
	    	<label><strong>*</strong> Membership is being paid by:</label>
			<ol>
				<li><input type="radio" name="paid_by" value="Employer" class="required radio_check" /><label class="radio_check">Employer</label></li>
				<li><input type="radio" name="paid_by" value="You" class="radio_check" /><label class="radio_check">You</label></li>
			</ol>
	    </li>
		<li>
			<p>The questions below are OPTIONAL. This information will help us better understand our membership, but these are NOT required for membership.</p>
		</li>
	    <li class="form_stack">
	    	<label>Your Age:</label>
			<ol>
				<li><input type="radio" name="member_age" value="under 20" class="radio_check" /><label class="radio_check">Under 20</label></li>
				<li><input type="radio" name="member_age" value="20-30" class="radio_check" /><label class="radio_check">20-30</label></li>
				<li><input type="radio" name="member_age" value="31-40" class="radio_check" /><label class="radio_check">31-40</label></li>
				<li><input type="radio" name="member_age" value="41-50" class="radio_check" /><label class="radio_check">41-50</label></li>
				<li><input type="radio" name="member_age" value="51-60" class="radio_check" /><label class="radio_check">51-60</label></li>
				<li><input type="radio" name="member_age" value="61-70" class="radio_check" /><label class="radio_check">61-70</label></li>
				<li><input type="radio" name="member_age" value="71+" class="radio_check" /><label class="radio_check">71+</label></li>
			</ol>
	    </li>
	    <li class="form_stack">
	    	<label>Years in the industry:</label>
			<ol>
				<li><input type="radio" name="industry_years" value="0-2" class="radio_check" /><label class="radio_check">0-2</label></li>
				<li><input type="radio" name="industry_years" value="3-5" class="radio_check" /><label class="radio_check">3-5</label></li>
				<li><input type="radio" name="industry_years" value="6-10" class="radio_check" /><label class="radio_check">6-10</label></li>
				<li><input type="radio" name="industry_years" value="11-15" class="radio_check" /><label class="radio_check">11-15</label></li>
				<li><input type="radio" name="industry_years" value="16-20" class="radio_check" /><label class="radio_check">16-20</label></li>
				<li><input type="radio" name="industry_years" value="21-30" class="radio_check" /><label class="radio_check">21-30</label></li>
				<li><input type="radio" name="industry_years" value="31-40" class="radio_check" /><label class="radio_check">31-40</label></li>
				<li><input type="radio" name="industry_years" value="41+" class="radio_check" /><label class="radio_check">41+</label></li>
			</ol>
	    </li>
	    <li class="form_stack">
	    	<label>Ethnicity:</label>
			<ol>
				<li><input type="radio" name="ethnicity" value="Caucasian" class="radio_check" /><label class="radio_check">Caucasian</label></li>
				<li><input type="radio" name="ethnicity" value="African American" class="radio_check" /><label class="radio_check">African American</label></li>
				<li><input type="radio" name="ethnicity" value="Hispanic" class="radio_check" /><label class="radio_check">Hispanic</label></li>
				<li><input type="radio" name="ethnicity" value="American Indian" class="radio_check" /><label class="radio_check">American Indian</label></li>
				<li><input type="radio" name="ethnicity" value="Asian" class="radio_check" /><label class="radio_check">Asian</label></li>
				<li><input type="radio" name="ethnicity" value="Other" class="radio_check" /><label class="radio_check">Other</label></li>
				<li><input type="text" name="ethnicity_other" /></li>
			</ol>
	    </li>
	    <li class="form_stack">
	    	<label>What committee would you like to be involved with?</label>
			<ol>
				<li><input type="radio" name="committee" value="Addy&reg; Awards" class="radio_check" /><label class="radio_check">Addy&reg; Awards</label></li>
				<li><input type="radio" name="committee" value="Public Service Project" class="radio_check" /><label class="radio_check">Public Service Project</label></li>
				<li><input type="radio" name="committee" value="PR/Communications" class="radio_check" /><label class="radio_check">PR/Communications</label></li>
				<li><input type="radio" name="committee" value="Student Seminar" class="radio_check" /><label class="radio_check">Student Seminar</label></li>
				<li><input type="radio" name="committee" value="Programs" class="radio_check" /><label class="radio_check">Programs</label></li>
				<li><input type="radio" name="committee" value="Social Planning" class="radio_check" /><label class="radio_check">Social Planning</label></li>
				<li><input type="radio" name="committee" value="Membership" class="radio_check" /><label class="radio_check">Membership</label></li>
				<li><input type="radio" name="committee" value="Ambassador/Greeter" class="radio_check" /><label class="radio_check">Ambassador/Greeter</label></li>
				<li><input type="radio" name="committee" value="Other" class="radio_check" /><label class="radio_check">Other</label></li>
				<li><input type="text" name="committee_other" /></li>
			</ol>
	    </li>
	    <li>
			<p>As a non-profit organization, AAF of Des Moines needs vendor support to assist with club development.</p>
	    </li>
	    <li class="form_stack">
	    	<label>List any products or services you or your company can offer/provide to AAF of Des Moines in exchange for promotion.</label>
			<textarea name="services_offered"></textarea>
	    </li>
		
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
		
	    <li>
	    	<label>&nbsp;</label>
			<input type="image" src="/resources/images/btn_submit_app.png" class="submit_btn" />
	    </li>
	</ol>
</form>
<script type="text/javascript">
	$(document).ready(function() { 
		$("#member_apply").validate();
	});
</script>