$(document).ready(function() {
    $("#btn_send_message").click(
		function(){
			sendAjaxForm('send_message');
			return false;
		}
	);
});

function sendAjaxForm(send_message) {
    $.ajax({
        url: "../mdl/action_ajax_form.php",
        type:     "post",
        dataType: "html",
        data: $("#"+send_message).serialize()  // Сеарилизуем объект
 	});
}
