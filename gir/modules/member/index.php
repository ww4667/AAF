<?php
if(!isset($_SESSION)){
	session_start();
}

switch($method){
  
  /* Add Member */
  case 'create':
    // page 'template variables'
    $PAGE_BODY = "create.php";      /* which file to pull into the template */
    $PAGE_TITLE = "Creating Member";  /* what title to show on page */
    $m = new Member();
    
    if ( isset($_POST['first_name']) ) {
      $post_data = $_POST;
      $clean_data = array();
      foreach ($post_data as $key => $val) {
        $clean = trim($val);
        $clean_data[$key] = $clean;
      }
      $m->CreateItem($clean_data);
      $msg[] = "Member created successfully.";
      flash($msg);
    }   
    
    //the layout file  -  THIS PART NEEDS TO BE LAST
    require($_SERVER['DOCUMENT_ROOT']."/gir/views/layouts/shell.php");
  break;
  
  /* Add Member */
  case 'member-app':
    $m = new Member();
    $u = new User();
    
    if ( isset($_POST['first_name']) ) {
      $post_data = $_POST;
      $clean_data = array();
      foreach ($post_data as $key => $val) {
        $clean = trim($val);
        $clean_data[$key] = $clean;        
      }
      
      $u_id = $u->CreateItem($clean_data);
      
      $m->CreateItem($clean_data);     
      
      $m->JoinUser($u_id->newId);
      
        //this is where we send credit card information
    
    }   
    
  break;
  
  case 'member-login':
    $m = new Member();
    $u = new User();
    if (isset($_GET["reset_key"])) $reset_key = $_GET["reset_key"] ;
    
    if ( isset($_POST['username']) ) {
      $post_data = $_POST;
      $clean_data = array();
      foreach ($post_data as $key => $val) {
        $clean = trim($val);
        $clean_data[$key] = $clean;        
      }
    
        if ( isset($reset_key) ) {
            $users = $u->GetItemsObjByPropertyValue("email", $clean_data["username"]);
            $user = $users[0];
            //$user->PTS($user);
            if($user->password_reset == $reset_key ){         
                $salt = $u->GetSalt($clean_data["username"]);
                $user->salt = $salt;
                $user->password = $u->SetPassword($clean_data["password"], $salt );
                $user->password_reset = "";
                $user->UpdateItem();
                if($user->Login($clean_data["username"], $clean_data["password"])) print "Password changed and you are now loged in.";   
            } else {
                print "This Reset Key is not associated with your account.  Please check the code in your email and try again.";
            }
        } else {
            
            ($u->Login($clean_data["username"], $clean_data["password"])) ? print "Logged in" : print "login error, please try again.";                    
        }
    } else {   
    
        if ($reset_key == "" ){            
            $PAGE_BODY = "login_form.php";      /* which file to pull into the template */         
        } else {            
            $PAGE_BODY = "change_password.php";      /* which file to pull into the template */
        }
        require($_SERVER['DOCUMENT_ROOT']."/gir/views/layouts/shell.php");  
    }
    
  break;
  
  case 'does-email-exist':
      
        $u = new User();
        $result = $u->EmailCheck($_GET["email"]);
        
        (!$result) ? print "true": print "false";        
    
 
  break;
  case 'view-members':
    $m = new Member();
        
    $PAGE_BODY = "view_members.php";      /* which file to pull into the template */
     
    require($_SERVER['DOCUMENT_ROOT']."/gir/views/layouts/shell.php");  
  break;
	
  case "forgot-password":
    $m = new Member();
    $u = new User();
    
    if ( isset($_POST['email']) ) {
      $post_data = $_POST;
      $clean_data = array();
      foreach ($post_data as $key => $val) {
        $clean = trim($val);
        $clean_data[$key] = $clean;        
      }
        //check if user exists
        $result = $u->EmailCheck($clean_data["email"]);
        
        if($result){
            $items = $u->QueryObjectItems("email = '" . $clean_data["email"]  . "'");
            $user = $items[0];
            $user->SetPasswordResetKey($clean_data["email"]);
            //$user->PTS($user);
            $member = $m->getMemberByUserId($user->id);
            
            $email_data["email"] = $clean_data["email"];
            $email_data["fname"] = $member["first_name"];
            $email_data["lname"] = $member["last_name"];
            $email_data["password_reset"] = $user->password_reset;
            
            Mailer::reset_password_email($email_data);
            
            print "Instructions have been sent to your email address, please use the link to reset your password.";
            
        } else {
            print "Your email address is not found in our system - <a href='[[~49]]'>Try again</a> or <a tabindex='3' href='[[~11]]'>Join</a>";        
        }
           
        
    
    } else {
        
        
    $PAGE_BODY = "forgot_password.php";      /* which file to pull into the template */
     
    require($_SERVER['DOCUMENT_ROOT']."/gir/views/layouts/shell.php");  
        
    }
  break;
  
  case "member-logout":
      $u = new User();
      
      if($u->Logout()) print "logged out, thank you";
        
  break;

}

?>