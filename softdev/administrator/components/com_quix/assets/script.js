(function($){

  	$(document).ready(function(){
  		function saveAjaxIntegration(item){
  			$('input[name=task]').val('integrations.update');
		    // console.log($(this).is(':checked'));
		    
			var value   = $('#adminForm').serializeArray();
			// console.log(value);
			$.ajax({
				type   : 'POST',
				data   : value,
				beforeSend: function(){
		          	item.parent().parent().parent().addClass('disabled');
				    item.attr('disabled', true);
		        },
				success: function (res) {
					var response = JSON.parse(res);
					if(!response.success){
						console.log(response.data);
					}
					item.parent().parent().parent().removeClass('disabled');
				    item.attr('disabled', false);
					item.parent().parent().parent().find('.success-message').fadeIn('fast').delay(1000).fadeOut('fast');
				}
			});      
  		}

		$('.toggleIntegration').change(function() {
			var item = $(this);
			saveAjaxIntegration(item);
	 	});

	 	$('#customIntegrationSave').on('click', function(e) {
	 		e.preventDefault();
			var item = $(this);
			saveAjaxIntegration(item);
		 });
		 
		// new template modal  
		$('#collection-window-modal form').on('submit', function(e){
			e.preventDefault();
			if(!document.formvalidator.isValid(document.getElementById("item-form"))) return;
			
			$.ajax({
				url: 'index.php?option=com_quix&view=collections',
				type: 'post',
				dataType: 'json',
				data: $(this).serialize(),
				beforeSend:function(){
					jQuery('#collection-window-modal button[type=submit]').prop('disabled', 'true');
					window.parent.jQuery('#newLibraryModal').addClass('request-open');
				},
				complete:function(){
					// $('#collection-window-modal form').find('.loader').fadeOut();
				},
				success:function(result)
				{
					$('#collection-window-modal form .success').fadeIn();
					
					var data = result.data;
					window.parent.location = data.url;
				},
				error:function(result){
					$('#collection-window-modal form .error').fadeIn();
				}
			});
		});

 	});

})(jQuery);