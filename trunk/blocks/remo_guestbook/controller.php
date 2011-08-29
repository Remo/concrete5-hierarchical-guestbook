<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));	

class RemoGuestbookBlockController extends BlockController {

   protected $btInterfaceWidth = 300;
   protected $btInterfaceHeight = 320;
   protected $btTable = 'btRemoGuestbook';

   /** 
    * Used for localization. If we want to localize the name/description we have to include this
    */
   public function getBlockTypeDescription() {
      return t("Insert a guestbook with a tree like structure.");
   }
   
   public function getBlockTypeName() {
      return t("Hierarchical Guestbook");
   }	
   
   public function getEntries($parentID = 0, $currentLevel = 0) {
      $db = Loader::db();
      
      $tree = array();
      $result = $db->Execute("SELECT entryID, message, subject, name, emailAddress, websiteUrl, dateCreated FROM btRemoGuestbookEntries WHERE bID=? AND parentEntryID=? ORDER BY entryID desc", array($this->bID, $parentID));
      while ($row = $result->FetchNextObject(false)) {
         $row->level = $currentLevel;
         $tree[] = $row;
         
         $tree = array_merge($tree, $this->getEntries($row->entryID, $currentLevel+1));        
      }
      
      return $tree;
   }
      
   public function on_page_view() {
      $html = Loader::helper('html');
      $v = View::GetInstance();
      
      $v->addHeaderItem($html->css('remo.guestbook.css', 'remo_guestbook'));
      $v->addHeaderItem($html->javascript('remo.guestbook.js', 'remo_guestbook'));
      
   }  	
   
   public function isGuestbookAdmin() {
      $po = $this->getPermissionsObject(); 
		return $po->canWrite();
   }
   
   public function action_reply() {
      $db = Loader::db();
      
      $u = new User();
      if ($u->isLoggedIn()) {
         $ui = UserInfo::getByID($u->getUserID());
         $_POST['email'] = $ui->getUserEmail();
         $_POST['name']  = $u->getUserName();
      }
      
      $values = array($_POST['message'], $_POST['name'], $_POST['email'], $this->bID, $_POST['parentEntryID']);
      if ($db->Execute('INSERT INTO btRemoGuestbookEntries (message, name, emailAddress, dateCreated, bID, parentEntryID) VALUES (?,?,?,now(),?,?)', $values)) {
         $this->set('message', t('message posted.'));
      }
      else {
         $this->set('message', t('message not posted due to a database error, please try again later.'));      
         if (DEBUG_DISPLAY_ERRORS) {
            echo $db->ErrorMsg();
         }
      }
   }
   
   public function action_delete() {
      if (!$this->isGuestbookAdmin()) return;
            
      $db = Loader::db();
      $db->Execute('DELETE FROM btRemoGuestbookEntries WHERE entryID=?', array($_REQUEST['entryID']));
      
      $this->set('message', t('message deleted.'));
   }
}
?>
