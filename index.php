<?php
session_start();
require 'mdl/functions.php'; // подключение функций
require 'mdl/oauth.php'; // подключение класса для получения данных из фб

// создание экземпляра класса для получения данных из фб
$fb  = new FBAuth(array(
    "client_id" => "421992874923976",
    "client_secret" => "9b3e24d60a545f65441867084dabcf80",
    "redirect_uri" => "https://fortest.xyz/"
));

// если пришел код из фб, то запустить метод получения токена
if(isset($_GET["code"])){
    $fb->auth($_GET["code"]);
}

// выход из аккаунта при нажатие на кнопку
if($_GET['action'] === 'out'){
    out();
}

$link_fb = $fb->get_link(); // ссылка переход на фб для ввода логина, пароля
$id_social_net = $fb->user_info["id"]; // получение данных из фб
$first_name = $fb->user_info["first_name"]; // получение данных из фб
$last_name = $fb->user_info["last_name"]; // получение данных из фб
$user_ip = $_SERVER['REMOTE_ADDR']; // получение ip пользователя
$user_browser = $_SERVER["HTTP_USER_AGENT"];  // получение браузера пользователя
$date_created = date('Y-m-d H:i:s'); // дата создания сообщения

// если переменная id в сессии существует, то вывести главную страницу
if ($_SESSION['id']) {
    show_user_data();
} else {
    //была ли передана информация с фб?
    if($fb->auth_status){
        // записать пользователя в базу
        add_user($id_social_net, $first_name, $last_name, $user_ip, $user_browser, $date_created);
        // в переменную сессии записать id из базы
        add_id_in_session($id_social_net, $first_name, $last_name);
        // вывести главную страницу
        show_user_data();
    } else {
        // вывести страницу с регистрацией через фб
        require 'tpl/tpl1.php';
    }
}

?>
