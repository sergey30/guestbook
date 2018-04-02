function sendAjaxForm(send_message, url) {
    $.ajax({
        url: url,
        type: "post",
        dataType: "html",
        data: $("#"+send_message).serialize(),
        success: function(response) {
            $("#send_message textarea").val(""); // очистка формы после отправки
            $("#result_form .message").remove();
            $("#result_form .message_data").remove();
        	result = $.parseJSON(response);
            var id = "";
            var first_name = "";
            var last_name = "";
            var date_created = "";
            var message = "";
            for (var i = 0; i < result.length; i++) {
                id = result[i].id;
                first_name = result[i].first_name;
                last_name = result[i].last_name;
                date_created = result[i].date_created;
                message = result[i].message;
                remove = "remove";
                $("#result_form").prepend($("<div class='message'></div>").text(message));
                $("#result_form").prepend($("<div class='message_data mt-3 pl-3 text-primary'></div>").text(first_name + " " + last_name + " " + date_created));
    	    }
        }
    });
}

$(document).ready(function() {
    $("#btn_send_message").click(
		function(){
            //проверка, что бы скрипт не сработал, если форма пустая
            if ($("#send_message textarea").val()) {
                sendAjaxForm('send_message', '../mdl/action_ajax_form.php');
    			return false;
            }
            return false;
		}
	);
});
