/* ao.js */

function toggle_obj(e)
{
    var that = $(this);
    var type = that.attr('id').slice(4);
    var fragment = $('#form_fragment_'+type);
    $('.obj_selector').removeClass('obj_selected');
    that.addClass('obj_selected');
    //      if(!fragment.is(':visible'))
    {
        if(type === 'text')
        {
            $('#obj_type').val('text_t');
        }
        else
        {
            $('#obj_type').val('image_t');
        }
    }
    $('.form_fragment').hide();
    fragment.show();
}

function toggle_tag(e)
{
    var that = $(this);
    $('.input_tag_selected').remove();
    if(that.hasClass('tag_selected'))
    {
        that.removeClass('tag_selected');
       
    }
    else
    {
        that.addClass('tag_selected');
    }
    
    var h_tags = $('#h_tags');
    
    $('.tag_selected').each(function(idx, o){
        var t = $(o).text();
        var id = tags[t];
        h_tags.append('<input class="input_tag_selected"  type="hidden" name="data[Tag][Tag]['+idx+']" value="'+id+'" />');
    });
}

function new_tag(e)
{
    var input = $('#new_tag_val');
    var t = input.val();
    $.post('/tags/add', {Tag:{tag_name:t}}, function(data){
//         console.log(data);
        if(data.result)
        {
            tags[data.tag.tag_name] = data.tag.id;
            var nt = $('<div class="tag_value">'+data.tag.tag_name+'</div>');
            $('#select_tag_box').append(nt);
            nt.on('click', toggle_tag);
            toggle_tag.apply(nt, []);
        }
        input.val('');
        
    }, 'json');
            
            
}

function mark_img_update(evt){
    var that = $(this);
    if(that.val() != '')
    {
        if($('#mark_img_update').length == 0)
        {
            $('#form_specie').append('<input type="hidden" id="mark_img_update" name="img_update" value="1" />');
        }
    }
}
            
$(document).ready(function(){
	
		
	$('.obj_selector').on('click', toggle_obj);
    $('.tag_value').on('click', toggle_tag);
	$('#new_tag').on('click', new_tag);
    
    $('#ObjImageFile').on('change', mark_img_update);
    $('#ObjPublished').datepicker({ dateFormat: "yy-mm-dd" });
    
    
    if($('#obj_type').val() === 'image_t')
    {
        $('#obj_image').click();
    }
    else
    {
        $('#obj_text').click();
    }
});