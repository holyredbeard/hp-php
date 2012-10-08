$(document).ready(function() {
	$('#form3').submit(function() {

		$('input[type=checkbox]').each(function () {
			if( this.checked ) {
				var confirmBox = confirm('Do you really want to remove the user(s)?');

				if (!confirmBox) {
					return false;
				}
		    }
		});
	});
});