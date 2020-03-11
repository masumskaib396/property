(function($) {
"use strict";

/*------------------------------------------------------------------
[Table of contents]


-------------------------------------------------------------------*/

/*--------------------------------------------------------------
CUSTOM PRE DEFINE FUNCTION
------------------------------------------------------------*/
/* is_exist() */
jQuery.fn.is_exist = function(){
  return this.length;
}


$(function(){


$('.vdm_all_checked').on('change', function(){
	var $self = $(this),
		$form = $self.closest('.vdm-table'),
		$box = $form.find('input[type="checkbox"][name="vdm_download_files[]"]');

	if( $self.is(':checked') ) {
	 	$box.prop('checked', 'checked');
	} else {
		$box.prop('checked', '');
	}
});


  $('ul.tabs li').click(function(){
    var tab_id = $(this).attr('data-tab');

    $('ul.tabs li').removeClass('current');
    $('.tab-content').removeClass('current');

    $(this).addClass('current');
    $("#"+tab_id).addClass('current');
  })


$('#vdm_login').on('submit', function(e){
	e.preventDefault();

	var $self = $(this);

	var remember = false;
	if( $('#remember').is(':checked') ) {
		remember = true;
	}

	$('.vdm-form-msg').html('');

	$.ajax({
		url: vdm_params.ajax_url,
		type: 'POST',
		data: {
			action: 'vmd_login',
			nonce: vdm_params.nonce,
			user_login: $('#user_login').val(),
			user_pass: $('#user_pass').val(),
			remember: remember
		},
		success: function(response){
			console.log( response );
			if( response.success === true ) {
				$('.vdm-form-msg').html('').append('<p>'+response.data+'</p>')
				window.location.href = vdm_params.redirect_url;
			} else {
				$('.vdm-form-msg').html('').append('<p>'+response.data+'</p>')
				$self[0].reset();
			}
		}
	})
	
	
})

console.log( vdm_params );

});/*End document ready*/


//login popup
$('.popup').magnificPopup({
  type:'inline',
  midClick: true 
});


$(window).on("resize", function(){

}); // end window resize


$(window).on("load" ,function(){


}); // End window LODE


})(jQuery);






