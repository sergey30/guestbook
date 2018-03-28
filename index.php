<?php
session_start(); // старт сессии
require 'mdl/functions.php'; // подключаем разные функции
require 'mdl/oauth.php'; // подключаем класс для получения данных из фб

$fb  = new FBAuth(array(
    "client_id" => "421992874923976",
    "client_secret" => "9b3e24d60a545f65441867084dabcf80",
    "redirect_uri" => "https://fortest.xyz/"
)); // создаем экземпляр класса для получения данных из фб

if(isset($_GET["code"])){
    $fb->auth($_GET["code"]);
} // если пришел код из фб, то запустить метод получения токена

$link_fb = $fb->get_link(); // ссылка переход на фб для ввода логина, пароля
$id_social_net = $fb->user_info["id"];
$first_name = $fb->user_info["first_name"];
$last_name = $fb->user_info["last_name"];
$user_ip = $_SERVER['REMOTE_ADDR'];
$user_browser = $_SERVER["HTTP_USER_AGENT"];
$date_created = date('Y-m-d H:i:s');

// получить id из базы и сверяем с sessin id если одниковые вывести шаблон функцией show_user_data();
if ($_SESSION['id']) {
    get_id($_SESSION['id']);
}

if (1 === 0) {
    require 'tpl/tpl2.php';
} else {
    if($fb->auth_status){ //была ли передана информация с фб?
        add_user($id_social_net, $first_name, $last_name, $user_ip, $user_browser, $date_created);
        add_id_in_session($id_social_net, $first_name, $last_name);
        show_user_data();
    } else {
        require 'tpl/tpl1.php';
    }
}

?>
