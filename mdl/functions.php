<?php
function addUser($name, $surname, $id_social_net) {
    try {
        $dbh = new PDO('mysql:dbname=guestbook_db;host=localhost', 'guestbook', '1');
    } catch (Exception $e) {
        die($e->getMessage());
    }
    $sth = $dbh->prepare("INSERT INTO `users` SET
        `name` = :name,
        `surname` = :surname,
        `id_social_net` =:id_social_net");
    $sth->execute(array('name' => $name,
                        'surname' => $surname,
                        'id_social_net' => $id_social_net));
}



 ?>
