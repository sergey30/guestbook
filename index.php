<?php
session_start(); // старт сессии
require 'mdl/functions.php'; // подключаем разные функции
require_once 'mdl/oauth.php'; // подключаем класс

$fb  = new FBAuth(array(
    "client_id" => "421992874923976",
    "client_secret" => "9b3e24d60a545f65441867084dabcf80",
    "redirect_uri" => "https://fortest.xyz/"
));

if(isset($_GET["code"])){
    $fb->auth($_GET["code"]);
}

$link_fb = $fb->get_link(); // ссылка переход на фб для ввода логина, пароля
$first_name = $fb->user_info["first_name"];
$last_name = $fb->user_info["last_name"];
$id_social_net = $fb->user_info["id"];
$ip_user = $_SERVER['REMOTE_ADDR'];


if (isset($_SESSION['id']) || (isset($_COOKIE['login']) && isset($_COOKIE['password']))) {
    echo "string";
} else {
    if($fb->auth_status){
        addUser($first_name, $last_name, $id_social_net);
        require 'tpl/messages.php';
    } else {
        require 'tpl/authorization.php';
    }
}

?>
