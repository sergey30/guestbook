$(document).ready(function() {
    $("#btn_send_message").click(
		function(){
			sendAjaxForm('send_message', '../mdl/action_ajax_form.php');
			return false;
		}
	);
});

function sendAjaxForm(send_message, url) {
    $.ajax({
        url: url,
        type: "post",
        dataType: "html",
        data: $("#"+send_message).serialize(),
        success: function(response) {
        	result = $.parseJSON(response);
        	$('#result_form').html('Имя: '+result.message);
    	}
 	});
}






//
// $(document).ready(function() {
//     $("#btn").click(
// 		function(){
// 			sendAjaxForm('result_form', 'ajax_form', 'action_ajax_form.php');
// 		}
// 	);
// });
//
// function sendAjaxForm(result_form, ajax_form, url) {
//     $.ajax({
//         url:     url, //url страницы (action_ajax_form.php)
//         type:     "POST", //метод отправки
//         dataType: "html", //формат данных
//         data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
//         success: function(response) { //Данные отправлены успешно
//         	result = $.parseJSON(response);
//         	$('#result_form').html('Имя: '+result.name+'<br>Телефон: '+result.phonenumber);
//     	},
//     	error: function(response) { // Данные не отправлены
//             $('#result_form').html('Ошибка. Данные не отправлены.');
//     	}
//  	});
// }
