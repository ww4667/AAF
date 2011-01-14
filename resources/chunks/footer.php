<div id="footer">
	<address>American Advertising Federation of Des Moines &nbsp;|&nbsp; P.O. Box 133 Des Moines, IA 50301</address>
	<a class="hidden" tabindex="27" accesskey="B" href="#wrapper">Back to top</a>
</div>
<style>
	/* the overlayed element */
.overlay {
	
	/* must be initially hidden */
	display:none;
	
	/* place overlay on top of other elements */
	z-index:10000;
	
	/* styling */
	background-color:#fff;
	
	width:460px;	
	min-height:200px;
	border:1px solid #666;
	
	/* CSS3 styling for latest browsers */
	-moz-box-shadow:0 0 90px 5px #000;
	-webkit-box-shadow: 0 0 90px #000;	
}

/* close button positioned on upper right corner */
.overlay .close {
	background-image:url(/resources/images/close.png);
	position:absolute;
	right:-15px;
	top:-15px;
	cursor:pointer;
	height:35px;
	width:35px;
}
.overlay_content {padding:30px}
.overlay_content h3 {font-size:1.2em;font-weight:bold;margin:0 0 5px 0}
</style>
<div id="sponsor_form" class="overlay">
	<div class="overlay_content">
		<h3>Become a Sponsor</h3>
		<p>If you are interested in sponsoring one of our lunch meetings or this Web site, please contact us for more information.</p>
		<form id="become_a_sponsor" class="form" action="" method="post" accept-charset="utf-8">
			<ol>
			    <li>
			    	<label><strong>*</strong> Organization Name:</label>
					<input name="org_name" type="text" class="required" />
			    </li>
			    <li>
			    	<label><strong>*</strong> Contact Name:</label>
					<input name="contact_name" type="text" class="required" />
			    </li>
			    <li>
			    	<label><strong>*</strong> Email:</label>
					<input name="email" type="text" class="required email" />
			    </li>
			    <li>
			    	<label><strong>*</strong> Phone:</label>
					<input name="phone" type="text" class="required" />
			    </li>
			    <li>
			    	<label>Additional Information.</label>
					<textarea name="additional_info"></textarea>
			    </li>
			    <li>
			    	<label>&nbsp;</label>
					<input type="image" src="/resources/images/btn_submit.png" class="submit_btn" />
			    </li>
			</ol>
		</form>
		<div style="clear:both;"><!--spacer--></div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		// select one or more elements to be overlay triggers
		$(".more a[rel]").overlay();
		$("#become_a_sponsor").validate();
	});
</script>