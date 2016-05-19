$(document).ready(function(){

    //hide shows if is one or
    $('section.arrayset-container').each(function(){
        var min = $(this).data('min');
        var items = $(this).find('.arrayset-list .arrayset-item');
        if(items.length==1 && items.length <= min){
            items.find('.del-arrayset').hide()
        }
    });

    //hide on just one item or same as min
    $('.arrayset-container').on('click', '.del-arrayset',function(){
        var container = $(this).parents('section.arrayset-container');
        var min = container.data('min');
        var items = container.find('.arrayset-list .arrayset-item');

        if(items.length==2 && items.length-1 <= min){
            items.find('.del-arrayset').hide()
        }
        if(items.length>1){
            $(this).parents('div.arrayset-item').remove();
        }
    });

    $('.add-arrayset').on('click',function(){

        var	container = $(this).parents('section.arrayset-container'),
            item = container.children('.arrayset-sample'),
            html = item.html();
        var max = container.data('max');
        var items = container.find('.arrayset-list .arrayset-item');

        if(items.length >= max && max>0){
            alert('you can not add more than '+max+' item');
            return;
        }

        var	current_name = item.data('currentname'),// just replace all ArraySet[index]  of all the string
            to_name = item.data('samplename')+'['+container.data('length')+1+']';

        // html = html.replace(current_name, to_name);
        html=html.split(current_name).join(to_name);

        var list = container.find('.arrayset-list');
        list.append(html);
        list.find('[id*="'+to_name+'"]').each(function(){
            var id  = $(this).attr('id');
            id = id.split('[').join('-S-').split(']').join('-E');
            $(this).attr('id',id);
        });


        list.find('input, select, textarea').prop("disabled", false);
        list.data('length',length+1);
        var items = container.find('.arrayset-list .arrayset-item');
        if(items.length>1){
            items.find('.del-arrayset').show();
        }

        //inc counter
        container.data('length', container.data('length')+1);




    });

    $('.arrayset-sample input,.arrayset-sample select,.arrayset-sample textarea').prop("disabled", true);
    $('.fa-minus').on('click', function(){
        if($(this).hasClass('active')){
            return false;
        }
        $(this).parent().find('i').removeClass('active');
        $(this).addClass('active')


        $(this).closest('.arrayset-container').find('.arrayset-list fieldset.paydar-form-fieldset').each(function(){
            $(this).find('.form-element:not(:first)').hide();
        });
    });
    $('.fa-plus').on('click', function() {
        if($(this).hasClass('active')){
            return false;
        }
        $(this).parent().find('i').removeClass('active');
        $(this).addClass('active');
        $(this).closest('.arrayset-container').find('.arrayset-list fieldset.paydar-form-fieldset .form-element:not(:first)').show();
    });
    $('.arrayset-list.dragable').sortable({placeholder: "ui-state-highlight"});

});
//$('.arrayset-container').find('.del-file-one-item').hide();


//$('.arrayset-list.dragable').disableSelection();