
		<h2><strong>We've approved your application!</strong></h2>
          <table width="95%" border="0" cellspacing="0" cellpadding="10">
            <tr>
              <td bgcolor="#F5F5F5" style="background-color:#F5F5F5;font-size:12px;font-family:Arial, Helvetica, sans-serif;line-height:20px;color:#666">
				<!--BODY CONTENT START-->
				 <h3>Welcome <?= ucwords($object['fname']) ?>,</h3>
				 <p>We've approved your membership application. Please visit the website to setup your password and login.</p>
				 <p>Please use following link to setup your account - <a href="http://aaf.slashwebstudios.com/login.html?reset_key=<?= $object["password_reset"] ?>">http://aaf.slashwebstudios.com/login.html?reset_key=<?= $object["password_reset"] ?></a></p>
				 <p>Should you have any questions, comments, or suggestions, don't hesitate to <a href="http://www.aafdsm.com/contact.html">contact us</a>.</p>
				<!--BODY CONTENT END-->
				</td>
              </tr>
          </table>
            <img src="http://www.speech-buddies.com/assets/images/hordivider.gif" />
          <p>If you have any other questions, feel free to contact us at <a href="mailto:info@aafdsm.com">info@aafdsm.com</a>.</p>
