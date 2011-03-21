
<?php
//    phpinfo();

$op = $e->getObjectProperties();

if (!isset($_POST) || empty($_POST)){
?>
<form action="" method = "post" class = "form"id="submit_event_form" >
<ol>
<?
foreach($op as $p){
    switch($p["field"]){
        case "event_details":
          ?>
          <li><label><?= $p["label"] ?></label>
          <textarea id="<?= $p["id"] ?>" cols="55" class = "required" rows="7" name="<?= $p["field"] ?>"></textarea>
          </li>
          <?
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
        <input class="submit_btn" type="image" value="Send Event" src="/resources/images/submit.png" alt="Submit Event" />
     </li>
</ol>
</form>
<?
}
?>

<script type="text/javascript">
    $(document).ready(function() { 
        $("#submit_event_form").validate();
    });
</script>