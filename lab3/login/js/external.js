$(document).ready(function() {	

	$('#form3').submit(function() {
	    var submit = true;
	    $('input[type=checkbox]').each(function () {
	        if( this.checked ) {
	            var username = $(this).attr('user');

	            var confirmBox = confirm('Do you really want to remove the user ' + username + ' ?');

	            
				if (!confirmBox) {
					$(this).attr('checked', false); //Uncheck this box so that it isn't submitted
				}
	        }
	    });
	    return submit;
	});

});