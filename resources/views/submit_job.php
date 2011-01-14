<form class="form" action="[[~[[*id]]]]" method="post">

     <input name="nospam:blank" type="hidden" />

     <label for="name">Job Title:</label>
	 <p class="error">[[+fi.error.jobtitle]]</p>
     <input id="name" name="name:required" type="text" value="[[+fi.name]]" />
     
     <label for="email">Company:</label>
	 <p class="error">[[+fi.error.company]]</p>
     <input id="email" name="company:required" type="text" value="[[+fi.email]]" />

     <label for="text">Description:</label>
	 <p class="error">[[+fi.error.text]]</p>
     <textarea id="text" cols="55" rows="7" name="text:required:stripTags">[[+fi.text]]</textarea>

     <br class="clear" />

     <li>
     	<label>&nbsp;</label>
        <input class="submit_btn" type="image" value="Send Question" src="/resources/images/submit.png" alt="Submit Job" />
     </li>
	 
</form>