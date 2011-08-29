$(document).ready(function () {
   $(".remo-hierarchical-guestbook-reply").live("click", function(event) {
      event.preventDefault();
      
      var entryID = $(this).attr("id").substr(31);
      var $parentObject = $(this).parent();
      
      $.post(CCM_TOOLS_PATH + "/../packages/remo_guestbook/getreplyform", {"entryID": entryID, "action": remoGuestbookAction}, function(data) {      
         $parentObject.replaceWith(data);
      });
   });

});