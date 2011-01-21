
<?php
//    phpinfo();

$op = $j->getObjectProperties();

if (!isset($_POST) || empty($_POST)){
?>
<form action="" method = "post" class = "form"id="submit_job_form" >
<ol>
<?
foreach($op as $p){
    switch($p["field"]){
        case "description":
          ?>
          <li><label><?= $p["label"] ?></label>
          <textarea id="<?= $p["id"] ?>" cols="55" class = "required" rows="7" name="<?= $p["field"] ?>"></textarea>
          </li>
          <?
            break;
        case "approved":
            break;
        default:
          ?>
          <li>
          <label><?= $p["label"] ?></label>
          <input type = "text" class = "required"  name = "<?= $p["field"] ?>"/>
          </li>
          <?
          break;
        
    }
}

?>
     <li>
        <label>&nbsp;</label>
        <input class="submit_btn" type="image" value="Send Question" src="/resources/images/submit.png" alt="Submit Job" />
     </li>
</ol>
</form>
<?
}
?>

<script type="text/javascript">
    $(document).ready(function() { 
        $("#submit_job_form").validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                        remote: "/remote/does-email-exist.html"
                    }
                },
                messages: {
                    email: {
                        required: 'This field is required',
                        email: 'Enter a valid email address',
                        remote: 'Email address already registered.'
                    }
                }
            });
    });
</script>