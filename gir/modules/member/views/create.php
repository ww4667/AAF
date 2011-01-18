<?php
//    phpinfo();

$op = $m->getObjectProperties();

if (!isset($_POST)){
?>
<form action="" method = "post">
<?
foreach($op as $p){
  ?>
  <label><?= $p["label"] ?></label>
  <input type = "text" name = "<?= $p["field"] ?>"/>
  <?
}

?>
<input type = "submit" />
</form>
<?
}

?>
I'm creating a member...