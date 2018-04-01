function sendAjaxForm(send_message, url) {
    $.ajax({
        url: url,
        type: "post",
        dataType: "html",
        data: $("#"+send_message).serialize(),
        success: function(response) {
            $("#send_message textarea").val(""); // очистка формы после отправки
            $("#result_form").html("");
            $("#result_form").html("<div class='m-1'></div>");
        	result = $.parseJSON(response);
            var message = 0;
            for (var i = 0; i < result.length; i++) {
                message = result[i].message;
                $("#result_form div").after($("<div class='m-1'></div>").text(message));



                // при выполнение функции сначала должно удалиться все код в диве #result_form а потом при цикле for по одной строчке добавляться, при слежующем вызове функции, опять  удаляется весь код с контентом и заново запоняется из базы
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
