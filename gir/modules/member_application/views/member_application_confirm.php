<?  ?>

<form id="member_payment" class="form" action="" method="post" accept-charset="utf-8">
	<input type="hidden" name="aaf_join_form" />
	    
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
		
    <ol>
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
	    </li><li class="form_stack">
            <label> Amount:</label>
            <ol>
            <?   
                 $mc = new Membership_Classification();
                 $mc->formBuilder("select", $membership_classification);
            ?>
            </ol>
        </li>
		
	    <li>
	    	<label>&nbsp;</label>
			<input type="image" src="/resources/images/btn_submit_app.png" class="submit_btn" />
	    </li>
	</ol>
</form>