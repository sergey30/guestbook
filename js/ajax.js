// записывается сообщение в базу
function addMessage(send_message, url) {
    $.ajax({
        url: url,
        type: "post",
        dataType: "html",
        data: $("#"+send_message).serialize(),
        success: function(response) {
            $("#send_message textarea").val(""); // очистка формы после отправки
            $("#result_form .message").remove(); // удалить динамически созданые элементы
            $("#result_form .remove").remove(); // удалить динамически созданые элементы
            $("#result_form .message_data").remove(); // удалить динамически созданые элементы
        	result = $.parseJSON(response);
            var id = "";
            var first_name = "";
            var last_name = "";
            var date_created = "";
            var message = "";
            // будет сформирован блок со всеми существующими сообщениями в базе, принадлежащие конкретному пользователю
            for (var i = 0; i < result.length; i++) {
                id = result[i].id;
                first_name = result[i].first_name;
                last_name = result[i].last_name;
                date_created = result[i].date_created;
                message = result[i].message;
                // формируются новые блоки и в них подставляются данные полученные из базы
                $("#result_form").prepend($("<div class='message'></div>").text(message));
                $("#result_form").prepend($("<a href='#' class='remove d-inline-block ml-5 pl-2 pr-2 border-danger border text-danger'></a>").text("remove message").attr("id", id));
                $("#result_form").prepend($("<span class='message_data d-inline-block mt-3 ml-3 text-primary'></span>").text(first_name + " " + last_name + " " + date_created));
    	    }
        }
    });
}

// после удаления из базы сообщения поступают обновленные данные
function deleteMessage(message_id, session_id, url) {
    $.ajax({
        url: url,
        type: "post",
        dataType: "html",
        data: {message_id:message_id, session_id:session_id}, // id сообщения и сессии для удаления
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
                $("#result_form").prepend($("<a href='#' class='remove d-inline-block ml-5 pl-2 pr-2 border-danger border text-danger'></a>").text("remove message").attr("id", id));
                $("#result_form").prepend($("<span class='message_data d-inline-block mt-3 ml-3 text-primary'></span>").text(first_name + " " + last_name + " " + date_created));
    	    }
        }
    });
}

// выводятся на экран все сообщения принадлежащие конкретному пользователю
function showMessage(session_id, url) {
    $.ajax({
        url: url,
        type: "post",
        dataType: "html",
        data: {session_id:session_id},
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
                $("#result_form").prepend($("<a href='#' class='remove d-inline-block ml-5 pl-2 pr-2 border-danger border text-danger'></a>").text("remove message").attr("id", id));
                $("#result_form").prepend($("<span class='message_data d-inline-block mt-3 ml-3 text-primary'></span>").text(first_name + " " + last_name + " " + date_created));
    	    }
        }
    });
}

// при нажатии кнопки Submit будет вызвана функция
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

// при нажатие в сообщение кнопки "remove message" будет вызвана функция
$(document).ready(function() {
    $("#result_form ").on("click", ".remove", function(){
        // взять id сообщения, что бы удалить именно его
        var message_id = $(this).attr("id");
        // взять id сессии из скрытого элемента формы
        var session_id = $("#send_message input").attr("value");
        if (message_id) {
            deleteMessage(message_id, session_id, "../mdl/ajax_remove_message.php");
            return false;
        }
        return false;
    });
});

// как только документ загружен сработает функция
$(document).ready(function() {
    var session_id = $("#send_message input").attr("value");
    showMessage(session_id, "../mdl/ajax_show_message.php");
});
