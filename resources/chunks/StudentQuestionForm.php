[[!FormIt?
&hooks=`spam,email,redirect`
&emailTpl=`StudentEmail`
&emailTo=`info@slashwebstudios.com`
&emailSubject=`Student Question from website`
&redirectTo=`38`
&smtpEnabled=`1`
&smtpAuth=`1`
&smtpHost=`smtp.gmail.com`
&smtpUsername=`burkhart.brett@gmail.com`
&smtpPassword=`Jesus50023`
&smtpPort=`465`
&smtpPrefix=`tls`
]]

<p>You got questions? We got answers. Ask us your question, and we'll get back to you faster than a speeding Prius.</p>

<form class="form" action="[[~[[*id]]]]" method="post">

     <input name="nospam:blank" type="hidden" />

     <label for="name">Name <strong>*</strong></label>
	 <p class="error">[[+fi.error.name]]</p>
     <input id="name" name="name:required" type="text" value="[[+fi.name]]" />
     
     <label for="email">Email <strong>*</strong></label>
	 <p class="error">[[+fi.error.email]]</p>
     <input id="email" name="email:email:required" type="text" value="[[+fi.email]]" />

     <label for="text">Question <strong>*</strong></label>
	 <p class="error">[[+fi.error.text]]</p>
     <textarea id="text" cols="55" rows="7" name="text:required:stripTags">[[+fi.text]]</textarea>

     <br class="clear" />

     <li>
     	<label>&nbsp;</label>
        <input class="submit_btn" type="image" value="Send Question" src="/resources/images/submit.png" alt="Submit Question" />
     </li>

</form>