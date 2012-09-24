/* ao.js */

$(document).ready(function(){
	
	$('#form_fragment_text').hide();
	$('#obj_type').val('image_t');
	
	function toggle_obj(e)
	{
		var that = $(this);
		var fragment = that.next('.form_fragment');
		if(!fragment.is(':visible'))
		{
			if(that.attr('id') == 'obj_text')
			{
				$('#obj_type').val('text_t');
			}
			else
			{
				$('#obj_type').val('image_t');
			}
			$('.form_fragment').hide();
			fragment.show();
		}
	}
	
	
	var selected_tags = Array();
	function add_tag(e)
	{
		var that = $(this);
		var t = that.next('.tag_value').text();
		that.removeClass('add_tag');
		that.addClass('remove_tag');
		that.text('(-)');
		selected_tags.push(t);
		$('#selected_tag_box').append('<input type="hidden" name="data[Tag][Tag]['+(selected_tags.length - 1)+']" value="'+tags[t]+'" />');
	}
	
	function new_tag(e)
	{
		
		var input = $('#new_tag_val');
		var t = input.val();
		$.post('/tags/add', {Tag:{name:t}}, function(data){
			console.log(data);
			if(data.result)
			{
				tags[data.tag.name] = data.tag.id;
				var nt = $('<div class="tag"><span class="action_tag remove_tag"> (-) </span><span class="tag_value">'+data.tag.name+'</span></div>');
				selected_tags.push(data.tag.name);
				$('#selected_tag_box').append('<input type="hidden" name="data[Tag][Tag]['+(selected_tags.length - 1)+']" value="'+data.tag.id+'" />');
				$('#select_tag_box').append(nt);
			}
			
		}, 'json');
		
		
	}
	
	$('.obj_selector').on('click', toggle_obj);
	$('.add_tag').on('click', add_tag);
	$('#new_tag').on('click', new_tag);
});