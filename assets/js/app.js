$('input[type=radio]').click(function(){
    $('.area').hide();
    $('#' + $(this).val()).show(); 
});

// some of the js are in the bottom of the page