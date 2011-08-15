$(document).ready(function () {
   $(".remo-hierarchical-guestbook-reply").live("click", function(event) {
      event.preventDefault();
      
      var entryID = $(this).attr("id").substr(31);
      
      $(this).parent().replaceWith("<div> \
         <form method=\"post\" action=\""+remoGuestbookAction+"\"> \
            <input type=\"hidden\" name=\"parentEntryID\" value=\""+entryID+"\"> \
            Name: <input type=\"text\" name=\"name\" value\"\"/> \
            E-Mail: <input type=\"text\" name=\"email\" value\"\"/> \
            <textarea name=\"message\" class=\"remo-hierarchical-guestbook-message\"></textarea> \
            <input class=\"remo-hierarchical-guestbook-submit\" type=\"submit\"/> \
         </form> \
         </div>");

   });

});