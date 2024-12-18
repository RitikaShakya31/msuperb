







// FOR FAQS
jQuery(document).ready(function($) {
    $(".faq-que button").click(function() {
        var $this = $(this).closest(".faq-que");
        var $answer = $this.next(".faq-ans");

        if ($answer.is(":visible")) {
            $answer.slideUp();
        } else {
            $(".faq-ans").slideUp();
            $answer.slideDown();
        }
    });
});

// FOR ORDER LIST
jQuery(document).ready(function($){
    
    var panels = $(".orderlist-body").hide();

    panels.first().show();
    
     $(".orderlist-head").click(function(){

         var $this = $(this);

         panels.slideUp();
         $this.next().slideDown();
         
    });

});