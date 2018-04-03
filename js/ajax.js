function addMessage(send_message, url) {
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
                $("#result_form").prepend($("<div class='message'></div>").text(message));
                $("#result_form").prepend($("<a href='#' class='remove d-inline-block ml-5 text-danger'></a>").text("remove").attr("id", id));
                $("#result_form").prepend($("<span class='message_data d-inline-block mt-3 ml-3 text-primary'></span>").text(first_name + " " + last_name + " " + date_created));
    	    }
        }
    });
}

function deleteMessage(message_id, session_id, url) {
    $.ajax({
        url: url,
        type: "post",
        dataType: "html",
        data: {message_id:message_id, session_id:session_id},
        success: function(response) {
            result = $.parseJSON(response);
            $("#result_form .message").remove();
            $("#result_form .remove").remove();
            $("#result_form .message_data").remove();
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
                $("#result_form").prepend($("<div class='message'></div>").text(message));
                $("#result_form").prepend($("<a href='#' class='remove d-inline-block ml-5 text-danger'></a>").text("remove").attr("id", id));
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
                addMessage("send_message", "../mdl/ajax_add_message.php");
    			return false;
            }
            return false;
		}
	);
});

$(document).ready(function() {
    $("#result_form ").on("click", ".remove", function(){
        var message_id = $(this).attr("id");
        var session_id = $("#send_message input").attr("value");
        if (message_id) {
            deleteMessage(message_id, session_id, "../mdl/ajax_remove_message.php");
            //alert(id);
            return false;
        }
        return false;
    });
});















//
