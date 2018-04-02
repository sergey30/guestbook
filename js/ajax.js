function sendAjaxForm(send_message, url) {
    $.ajax({
        url: url,
        type: "post",
        dataType: "html",
        data: $("#"+send_message).serialize(),
        success: function(response) {
            $("#send_message textarea").val(""); // очистка формы после отправки
            $("#result_form .message").remove();
            $("#result_form .remove").remove();
            $("#result_form .message_data").remove();
        	result = $.parseJSON(response);
            var remove = "remove";
            var first_name = "";
            var last_name = "";
            var date_created = "";
            var message = "";
            for (var i = 0; i < result.length; i++) {
                remove = result[i].id;
                first_name = result[i].first_name;
                last_name = result[i].last_name;
                date_created = result[i].date_created;
                message = result[i].message;
                $("#result_form").prepend($("<div class='message'></div>").text(message));
                $("#result_form").prepend($("<a class='remove d-inline-block ml-5 text-danger'></a>").text(remove));
                $("#result_form").prepend($("<span class='message_data d-inline-block mt-3 ml-3 text-primary'></span>").text(first_name + " " + last_name + " " + date_created));
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
//
// $(function() {
//    $("#result_form .remove").click(
//        function() {
//            event.preventDefault();
//            alert("6");
//        }
//    );
// });
