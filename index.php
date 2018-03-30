<?php
session_start(); // старт сессии
require 'mdl/functions.php'; // подключение функции
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

if ($_POST['submit'] === 'ok') {
    add_message();
}

$link_fb = $fb->get_link(); // ссылка переход на фб для ввода логина, пароля
$id_social_net = $fb->user_info["id"];
$first_name = $fb->user_info["first_name"];
$last_name = $fb->user_info["last_name"];
$user_ip = $_SERVER['REMOTE_ADDR'];
$user_browser = $_SERVER["HTTP_USER_AGENT"];
$date_created = date('Y-m-d H:i:s');

// если переменная id существует в сессии, то вывести главную страницу
if ($_SESSION['id']) {
    show_user_data();
} else {
    if($fb->auth_status){ //была ли передана информация с фб?
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
