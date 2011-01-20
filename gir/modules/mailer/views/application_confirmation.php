
		<h2><strong>We've received your application!</strong></h2>
          <table width="95%" border="0" cellspacing="0" cellpadding="10">
            <tr>
              <td bgcolor="#F5F5F5" style="background-color:#F5F5F5;font-size:12px;font-family:Arial, Helvetica, sans-serif;line-height:20px;color:#666">
				<!--BODY CONTENT START-->
				 <h3>Thank you <?= ucwords($object['fname']) ?>,</h3>
				 <p>We've received your membership application. After we review the application we will send you an email with your application status and further instructions.</p>
				 <h3>Application Data:</h3>
				 <ul>				 	
				 <? foreach ( $object['application_data'] as $key => $val ) { ?>
					 <? if ( $key != "aaf_join_form" && $key != "x" && $key != "y" ) { ?>
					 <li><strong><?= ucwords(str_replace("_", " ", $key)) ?>:</strong><br /><?= $val ?></li>
					 <? } ?>
				 <? } ?>
				 </ul>
				 <p>Should you have any questions, comments, or suggestions, don't hesitate to <a href="http://www.aafdsm.com/contact.html">contact us</a>.</p>
				<!--BODY CONTENT END-->
				</td>
              </tr>
          </table>
            <img src="http://www.speech-buddies.com/assets/images/hordivider.gif" />
          <p>If you have any other questions, feel free to contact us at <a href="mailto:info@aafdsm.com">info@aafdsm.com</a>.</p>
