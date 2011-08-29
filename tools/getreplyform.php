<?php   
defined('C5_EXECUTE') or die(_("Access Denied."));

$u = new User();
?>
<div> 
<form method="post" action="<?php echo $_REQUEST['action']?>">
   <input type="hidden" name="parentEntryID" value="<?php echo $_REQUEST['entryID']?>">
<?php

if ($u->isLoggedIn()) {
   $ui = UserInfo::getByID($u->getUserID());
   echo t("You are posting your message as:") . ' ' . $u->getUserName() . " (".$ui->getUserEmail().")";
}
else {
   echo t('Name:');
   echo '<input type="text" name="name" value=""/>';
   echo t('E-Mail:');
   echo '<input type="text" name="email" value=""/>';
}
?>
   <textarea name="message" class="remo-hierarchical-guestbook-message"></textarea>
   <input class="remo-hierarchical-guestbook-submit" type="submit"/>
</form>
</div>