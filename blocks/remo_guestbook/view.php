<?php   
defined('C5_EXECUTE') or die(_("Access Denied."));

global $bv;

$fh = Loader::helper('form');
$bv = $this;
     
echo '<script type="text/javascript">var remoGuestbookAction="'.$this->action('reply').'"</script>';
      
echo '<br/><br/><br/><br/>';

if (isset($message)) {
   echo "<p>$message</p>";
}

if (!function_exists('printGuestbookEntry')) {
   function printGuestbookEntry($item, $key) {
      global $bv;
      
      $indentLeft = $item->level * 30;
      echo "<div class=\"remo-hierarchical-guestbook-entry\" style=\"margin-left:{$indentLeft}px\">";
         echo "<div style=\"float:left;width:100%\">";
            echo "<div style=\"padding-right:100px;\">{$item->message}</div>";
            echo "<div class=\"remo-hierarchical-guestbook-actions\">";
            echo date('d.m.Y', strtotime($item->dateCreated));
            echo sprintf(" <a href=\"\" class=\"remo-hierarchical-guestbook-reply\" id=\"remo-hierarchical-guestbook-id-{$item->entryID}\">%s</a>", t('reply'));
            if ($bv->controller->isGuestbookAdmin()) {
               echo sprintf(" <a href=\"%s\">%s</a>", $bv->action('delete') . '&entryID=' . $item->entryID, t('delete'));
            }
            echo "</div>";
         echo "</div>";
         echo "<div style=\"float:left;width:0px;margin-left:-100px;padding-left:20px;\">";
         echo "sadf";
         echo "</div>";
         echo "<div style=\"clear:both;\"></div>";
         
      echo "</div>";
   }
}
   
$entries = $this->controller->getEntries();

array_walk_recursive($entries, 'printGuestbookEntry');

echo "<div>";
echo sprintf("<a href=\"\" class=\"remo-hierarchical-guestbook-reply\" id=\"remo-hierarchical-guestbook-id-0\">%s</a>", t('reply'));
echo "</div>";

            
?>
