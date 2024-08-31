$(document).ready(function(){
    initializeContent();
})

function initializeContent(){
// Sign In
$("#main_form_changer").click(function(){
    $.ajax({        
        url: 'second_placeholder.php',

        cache: false,
        success: function(second_placeholder){
            $("#main_container").html(second_placeholder);
            initializeContent();
        }
    })
});
// Back Arrow
$("#back_arrow").click(function(){
    $.ajax({        
        url: 'main_placeholder.php',
        success: function(main_placeholder){
            $("#main_container").html(main_placeholder);
            initializeContent();
        }
    })
});
}
