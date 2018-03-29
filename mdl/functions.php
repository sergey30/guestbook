<?php
// запрос из базы пользователя с данными переданными из фб, если в $array возвращается false создать новую запись в базе с полученными данными, если true ничего не делать
function add_user($id_social_net, $first_name, $last_name, $user_ip, $user_browser, $date_created) {
    try {
        $dbh = new PDO('mysql:dbname=guestbook_db;host=localhost', 'guestbook', '1');
    } catch (Exception $e) {
        die($e->getMessage());
    }

    $sth = $dbh->prepare("SELECT * FROM users WHERE
        id_social_net = :id_social_net and
        first_name = :first_name and
        last_name = :last_name");
    $sth->execute(array('id_social_net' => $id_social_net,
                        'first_name' => $first_name,
                        'last_name' => $last_name));
    $array = $sth->fetch(PDO::FETCH_ASSOC);

    if (!$array) {
        $sth = $dbh->prepare("INSERT INTO users SET
            id_social_net = :id_social_net,
            first_name = :first_name,
            last_name = :last_name,
            user_ip = :user_ip,
            user_browser = :user_browser,
            date_created = :date_created");
        $sth->execute(array('id_social_net' => $id_social_net,
                            'first_name' => $first_name,
                            'last_name' => $last_name,
                            'user_ip' => $user_ip,
                            'user_browser' => $user_browser,
                            'date_created' => $date_created));
    }
}

// взять из базы и вывести на экран данные пользователя
function show_user_data() {
    try {
        $dbh = new PDO('mysql:dbname=guestbook_db;host=localhost', 'guestbook', '1');
    } catch (Exception $e) {
        die($e->getMessage());
    }

    $sth = $dbh->prepare("SELECT id_social_net, first_name, last_name FROM users WHERE
        id = :id");
    $sth->execute(array('id' => $_SESSION['id']));
    $array = $sth->fetch(PDO::FETCH_ASSOC);
    require 'tpl/tpl2.php';
}

// взять данные полученные из фб, найти соответствующую им запись в базе и id этой записи сохранить в переменную сессии
function add_id_in_session($id_social_net, $first_name, $last_name) {
    try {
        $dbh = new PDO('mysql:dbname=guestbook_db;host=localhost', 'guestbook', '1');
    } catch (Exception $e) {
        die($e->getMessage());
    }

    $sth = $dbh->prepare("SELECT id FROM users WHERE
        id_social_net = :id_social_net and
        first_name = :first_name and
        last_name = :last_name");
    $sth->execute(array('id_social_net' => $id_social_net,
                        'first_name' => $first_name,
                        'last_name' => $last_name));
    $array = $sth->fetch(PDO::FETCH_ASSOC);

    $_SESSION['id'] = $array['id'];
}

// получить id пользователя из базы
// function get_id($id) {
//     try {
//         $dbh = new PDO('mysql:dbname=guestbook_db;host=localhost', 'guestbook', '1');
//     } catch (Exception $e) {
//         die($e->getMessage());
//     }
//
//     $sth = $dbh->prepare("SELECT * FROM users WHERE id = :id");
//     $sth->execute(array('id' => $_SESSION['id']));
//     $array = $sth->fetch(PDO::FETCH_ASSOC);
//     print_r($array);
//
// }

// выход из аккаунта при нажатие на кнопку
function out() {
    unset($_SESSION['id']);
    header('Location: https://fortest.xyz/');
}
 ?>
