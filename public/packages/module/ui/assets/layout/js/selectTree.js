/**
 * Created by pooria on 10/9/15.
 */

$(document).ready(function () {
    $(".selectP").click(function (event) {

        $(".selectedd").removeClass("selectedd");
        if ($('#parenting').val() !== event.target.id) {
          //  alert(event.target.id);
            $(event.target).parent().attr('class', 'selectedd');
            $('#parenting').attr('value', event.target.id);

        }
        else {
            $(".selectedd").removeClass("selectedd");
            $('#parenting').attr('value', '');
        }


    });

    $('label.tree-toggler').click(function () {
        var icon = $(this).children(".fa");
        if(icon.hasClass("fa-folder-o")){
            icon.removeClass("fa-folder-o").addClass("fa-folder-open-o");
        }else{
            icon.removeClass("fa-folder-open-o").addClass("fa-folder-o");
        }

        $(this).parent().children('ul.tree').toggle(300,function(){
            $(this).parent().toggleClass("open");
            $(".tree .nscroller").nanoScroller({ preventPageScrolling: true });
        });
    });
});