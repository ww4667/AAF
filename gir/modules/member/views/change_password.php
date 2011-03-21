
    <script type="text/javascript" src="resources/js/login-check.js"></script>

<form action="" method="post" accept-charset="utf-8" class="form">
	<ol>
		<li>
			<label for="username">Username</label>
			<input type="text" name="username" value="" id="username">
		</li>
		<li>
			<label for="password">Password</label>
			<input type="password" name="password" value="" id="password">
		</li>
        <li>
            <label for="password">Confirm Password</label>
            <input type="password" name="confirm_password" value="" id="confirm_password"> 
            <div style="font-weight: bold;" id="passwordCheck"> </div>
        </li>
		<li>
	     	<label>&nbsp;</label>
	     	<div id = "fadedButton">     
        Invalid form.</div>
        
        <div id = "showButton" style ="display: none;">     
         <input class="submit_btn" type="image" value="Login To Your Account" src="/resources/images/btn_login.png" alt="Login To Your Account" id ="login_form_submit"/>
       
        </div>          
	        </li>
		<li>
			<label>&nbsp;</label>
			<a href="[[~49]]">Forgot Your Password?</a>
		</li>
	</ol>
</form>

<script type="text/javascript">

    $('document').ready(function(){
    
        $('#login_form_submit').attr('disabled', 'disabled') ;
        
        $('#password').blur(function(){
        
        confirmPass()}
        
        ); 
        $('#confirm_password').blur(function(){
        confirmPass()
        });
        
    });

</script>