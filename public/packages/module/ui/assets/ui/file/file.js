
$(document).ready(function(){
    $('.del-file-one-item').on('click',function(){
        $(this).parent().find('.image-pop-up').remove();
        var parent = $(this).parent();
        var hidden = parent.find('input[type="hidden"]');
        var image = parent.find('img');
        var name = hidden.attr('name');
        parent.append('<input type="file" name="'+name+'" id="'+image.data('id')+'" >');
        hidden.remove();
        image.remove();
        $(this).remove();

    });
});
