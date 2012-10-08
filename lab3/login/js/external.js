$(document).ready(function() {
	$('#form3').submit(function() {
		
		var confirmBox = confirm('Do you really want to remove the user(s)?');

		if (!confirmBox) {
			return false;
		}
	});
});